# Nama file: Makefile

# Variabel
PHP=php
COMPOSER=composer
ARTISAN=$(PHP) artisan

# Default database (ubah sesuai kebutuhan)
DB_CONNECTION=mysql

# Target default
.DEFAULT_GOAL := help

help:
	@echo "Perintah yang tersedia:"
	@echo "  make setup           - Install composer, copy .env.example ke .env, generate key"
	@echo "  make migrate-fresh   - Jalankan migrate:fresh dan buat ulang user Filament"

setup:
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		echo ".env berhasil dibuat dari .env.example"; \
	fi
	$(COMPOSER) install
	$(ARTISAN) key:generate
	@echo "Setup selesai. Pastikan database ($(DB_CONNECTION)) sudah dibuat."

# Target untuk migrate fresh dan buat ulang user Filament
migrate-fresh:
	$(ARTISAN) migrate:fresh --seed
	@echo "Migrasi fresh selesai."
	@echo "Membuat ulang user Filament default..."
	$(ARTISAN) make:filament-user
