tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#1F3A8A',
                    dark: '#172554',
                    light: '#3B82F6',
                    subtle: '#EFF6FF',
                },
                secondary: '#DC2626',
                accent: '#059669',
                light: '#F8FAFC',
                dark: '#0F172A',
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                heading: ['Poppins', 'Inter', 'sans-serif'],
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'slide-left': 'slideLeft 0.6s ease-out',
                'fade-slide': 'fadeSlide 0.8s ease-out',
                'zoom-in': 'zoomIn 1.2s ease-out',
                float: 'float 6s ease-in-out infinite',
                'pulse-slow': 'pulse 3s ease-in-out infinite',
                'bounce-soft': 'bounceSoft 2s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                slideLeft: {
                    '0%': { transform: 'translateX(20px)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' },
                },
                fadeSlide: {
                    '0%': { transform: 'translateY(30px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                zoomIn: {
                    '0%': { transform: 'scale(1.1)', opacity: '0.8' },
                    '100%': { transform: 'scale(1)', opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                bounceSoft: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-5px)' },
                },
            },
        },
    },
};
