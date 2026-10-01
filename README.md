# Paperia

Paperia is a WordPress theme for paper and stationery online shops. It is built for stores that sell notebooks, writing paper, envelopes, and related stationery.

Created by **HamiDev**.

## Local development

The project runs WordPress in Docker, with MySQL and phpMyAdmin.

| Service     | URL                    |
| ----------- | ---------------------- |
| WordPress   | http://localhost:8080  |
| phpMyAdmin  | http://localhost:8081  |

### Requirements

- Docker
- Docker Compose

### Start

1. Copy the environment file and set your own passwords:

   ```bash
   cp .env.example .env
   ```

2. Start the stack:

   ```bash
   docker compose up -d
   ```

3. Open http://localhost:8080 and finish the WordPress installation.

WordPress files are mounted at `./wordpress` and are not committed. Database data is stored in the `db_data` volume.

PHP upload and memory limits are raised in `php.ini` so large WordPress and WooCommerce imports can run locally.
