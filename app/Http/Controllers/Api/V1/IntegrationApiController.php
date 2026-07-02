<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\InformationRequest;
use App\Models\PublicInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntegrationApiController extends Controller
{
    /**
     * Get a list of public informations.
     */
    public function getPublicInformations(Request $request)
    {
        $query = PublicInformation::with(['category', 'opd'])
            ->where('status', 'published')
            ->whereNotIn('id', function ($q) {
                // Exclude any information that has an exception (dikecualikan)
                $q->select('public_information_id')->from('information_exceptions');
            });

        // Filter by category_id if provided
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by year if provided
        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $informations = $query->latest('published_at')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $informations
        ]);
    }

    /**
     * Get a detail of public information.
     */
    public function getPublicInformationDetail($id)
    {
        $information = PublicInformation::with(['category', 'opd'])
            ->where('status', 'published')
            ->whereNotIn('id', function ($q) {
                $q->select('public_information_id')->from('information_exceptions');
            })
            ->find($id);

        if (!$information) {
            return response()->json([
                'status' => 'error',
                'message' => 'Information not found or is restricted.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $information
        ]);
    }

    /**
     * Get summary statistics of PPID.
     */
    public function getStatistics()
    {
        $totalPublicInformation = PublicInformation::where('status', 'published')
            ->whereNotIn('id', function ($q) {
                $q->select('public_information_id')->from('information_exceptions');
            })->count();

        $totalRequests = InformationRequest::count();
        $pendingRequests = InformationRequest::where('status', 'pending')->count();
        $approvedRequests = InformationRequest::where('status', 'approved')->count();
        $rejectedRequests = InformationRequest::where('status', 'rejected')->count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_public_information' => $totalPublicInformation,
                'requests' => [
                    'total' => $totalRequests,
                    'pending' => $pendingRequests,
                    'approved' => $approvedRequests,
                    'rejected' => $rejectedRequests,
                ]
            ]
        ]);
    }

    /**
     * Store a new information request.
     */
    public function storeInformationRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'opd_id' => 'nullable|exists:opds,id',
            'kategori_pemohon' => 'required|string',
            'nik_no_identitas' => 'required|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:255',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh' => 'required|string',
            'cara_mendapatkan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['status'] = 'pending';

        $informationRequest = InformationRequest::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Information request submitted successfully.',
            'data' => [
                'id' => $informationRequest->id,
                'nik_no_identitas' => $informationRequest->nik_no_identitas
            ]
        ], 201);
    }

    /**
     * Check the status of an information request.
     */
    public function checkInformationRequestStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nik_no_identitas' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $informationRequest = InformationRequest::where('id', $request->id)
            ->where('nik_no_identitas', $request->nik_no_identitas)
            ->first();

        if (!$informationRequest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Request not found or NIK is incorrect.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $informationRequest->id,
                'status' => $informationRequest->status,
                'response_message' => $informationRequest->response_message,
                'response_file' => $informationRequest->response_file,
                'responded_at' => $informationRequest->responded_at,
            ]
        ]);
    }
}
