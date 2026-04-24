-- SpaceCrafter
-- Reference SQL schema for recreating the original project structure.
-- This file is intended for archival and portfolio purposes.

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(60) NOT NULL UNIQUE,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    display_name VARCHAR(120) NOT NULL,
    bio TEXT NULL,
    avatar_path VARCHAR(255) NULL,
    preferred_language VARCHAR(10) NOT NULL DEFAULT 'es',
    preferred_units VARCHAR(20) NOT NULL DEFAULT 'SI',
    preferred_theme VARCHAR(20) NOT NULL DEFAULT 'dark',
    allow_notifications TINYINT(1) NOT NULL DEFAULT 1,
    show_in_community TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE habitats (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    public_id VARCHAR(32) NOT NULL UNIQUE,
    name VARCHAR(140) NOT NULL,
    description TEXT NULL,
    mission_type VARCHAR(40) NULL,
    crew_size INT UNSIGNED NOT NULL DEFAULT 6,
    duration_days INT UNSIGNED NULL,
    status ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
    occupied_cells INT UNSIGNED NOT NULL DEFAULT 0,
    score_total DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_functionality DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_weight DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_cost DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_efficiency DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_ergonomics DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    layout_json JSON NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_habitats_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE habitat_tags (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    habitat_id BIGINT UNSIGNED NOT NULL,
    tag VARCHAR(60) NOT NULL,
    CONSTRAINT fk_habitat_tags_habitat FOREIGN KEY (habitat_id) REFERENCES habitats(id) ON DELETE CASCADE
);

CREATE TABLE modules (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(60) NOT NULL UNIQUE,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(60) NOT NULL,
    description TEXT NULL,
    base_size ENUM('small', 'medium', 'large') NOT NULL DEFAULT 'small',
    score_functionality DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_weight DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_cost DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_efficiency DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    score_ergonomics DECIMAL(4,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE habitat_modules (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    habitat_id BIGINT UNSIGNED NOT NULL,
    module_id BIGINT UNSIGNED NOT NULL,
    instance_label VARCHAR(120) NULL,
    pos_x INT NOT NULL DEFAULT 0,
    pos_y INT NOT NULL DEFAULT 0,
    size_mode ENUM('small', 'medium', 'large') NOT NULL DEFAULT 'small',
    rotation_deg SMALLINT NOT NULL DEFAULT 0,
    metadata_json JSON NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_habitat_modules_habitat FOREIGN KEY (habitat_id) REFERENCES habitats(id) ON DELETE CASCADE,
    CONSTRAINT fk_habitat_modules_module FOREIGN KEY (module_id) REFERENCES modules(id) ON DELETE RESTRICT
);

CREATE TABLE habitat_votes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    habitat_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    vote TINYINT NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_habitat_vote (habitat_id, user_id),
    CONSTRAINT fk_habitat_votes_habitat FOREIGN KEY (habitat_id) REFERENCES habitats(id) ON DELETE CASCADE,
    CONSTRAINT fk_habitat_votes_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE habitat_comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    habitat_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_habitat_comments_habitat FOREIGN KEY (habitat_id) REFERENCES habitats(id) ON DELETE CASCADE,
    CONSTRAINT fk_habitat_comments_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE learning_articles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(80) NOT NULL UNIQUE,
    title VARCHAR(180) NOT NULL,
    category VARCHAR(80) NOT NULL,
    difficulty VARCHAR(40) NOT NULL,
    read_time_minutes INT UNSIGNED NOT NULL DEFAULT 5,
    summary TEXT NULL,
    content LONGTEXT NULL,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_badges (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    badge_code VARCHAR(80) NOT NULL,
    unlocked_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_user_badge (user_id, badge_code),
    CONSTRAINT fk_user_badges_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type VARCHAR(60) NOT NULL,
    title VARCHAR(160) NOT NULL,
    body TEXT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_notifications_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_habitats_user_status ON habitats(user_id, status);
CREATE INDEX idx_habitat_modules_habitat ON habitat_modules(habitat_id);
CREATE INDEX idx_comments_habitat_created ON habitat_comments(habitat_id, created_at);
