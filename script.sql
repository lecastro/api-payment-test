DO $$ BEGIN
    IF NOT EXISTS (SELECT FROM pg_database WHERE datname = 'laravel') THEN
        CREATE DATABASE laravel;
    END IF;
END $$;