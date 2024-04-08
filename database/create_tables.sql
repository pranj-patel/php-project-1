-- Database: `share_sphere`

PRAGMA foreign_keys=OFF;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` INTEGER PRIMARY KEY,
  `post_id` INTEGER NOT NULL,
  `user_id` INTEGER NOT NULL,
  `comment_id` INTEGER NOT NULL,
  `reply_to_id` INTEGER NOT NULL DEFAULT 0,
  `comment` TEXT NOT NULL,
  `user_name` TEXT DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime')),
  `updated_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime'))
);

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` INTEGER PRIMARY KEY,
  `post_id` INTEGER NOT NULL,
  `user_id` INTEGER NOT NULL,
  `created_at` DATETIME DEFAULT (datetime('now','localtime')),
  `updated_at` DATETIME DEFAULT (datetime('now','localtime'))
);

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` INTEGER PRIMARY KEY,
  `title` TEXT NOT NULL,
  `message` TEXT NOT NULL,
  `user_id` INTEGER NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime')),
  `updated_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime'))
);


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` INTEGER PRIMARY KEY,
  `name` TEXT NOT NULL,
  `slug` TEXT DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime')),
  `updated_at` DATETIME NOT NULL DEFAULT (datetime('now','localtime'))
);


--
-- Indexes for table `comments`
--
CREATE INDEX `idx_post_id` ON `comments` (`post_id`);
CREATE INDEX `idx_user_id` ON `comments` (`user_id`);
CREATE INDEX `idx_comment_id` ON `comments` (`comment_id`);
CREATE INDEX `idx_reply_to_id` ON `comments` (`reply_to_id`);

--
-- Indexes for table `likes`
--
CREATE INDEX `idx_post_id_likes` ON `likes` (`post_id`);
CREATE INDEX `idx_user_id_likes` ON `likes` (`user_id`);

--
-- Indexes for table `posts`
--
CREATE INDEX `idx_user_id_posts` ON `posts` (`user_id`);

--
-- AUTO_INCREMENT equivalent for SQLite3
--

-- It's not necessary to specify AUTO_INCREMENT for SQLite3 as it uses the AUTOINCREMENT keyword automatically for the primary key.

PRAGMA foreign_keys=ON;