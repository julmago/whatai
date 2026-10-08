-- MySQL 8+ schema for the first phase: user access only.
-- WhatsApp numbers, chats, and messages are intentionally outside this schema.

CREATE TABLE users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin', 'collaborator') NOT NULL,
    created_by_id BIGINT UNSIGNED NULL,

    PRIMARY KEY (id),
    UNIQUE KEY uq_users_username (username),
    KEY idx_users_created_by (created_by_id),

    CONSTRAINT fk_users_created_by
        FOREIGN KEY (created_by_id)
        REFERENCES users (id)
        ON DELETE RESTRICT
        ON UPDATE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARACTER SET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- The application must enforce the creation rules:
-- 1. Bootstrap exactly one super_admin account with username "julmago".
-- 2. A super_admin can create only admin accounts.
-- 3. An admin can create only collaborator accounts.
-- 4. A collaborator cannot create accounts.
-- Passwords must be hashed by the server before they are stored in password_hash.
