-- Inserting data for table `users`
INSERT INTO users (id, name, slug, created_at, updated_at) VALUES
(1, 'Harry', NULL, '2023-08-20 23:28:45', '2023-08-20 23:28:45'),
(2, 'Sonu', NULL, '2023-08-20 23:34:25', '2023-08-20 23:34:25'),
(3, 'John', NULL, '2023-08-20 23:38:30', '2023-08-20 23:38:30'),
(4, 'Sam', NULL, '2023-08-20 23:39:08', '2023-08-20 23:39:08'),
(5, 'Warren', NULL, '2023-08-20 23:42:32', '2023-08-20 23:42:32'),
(6, 'Benny', NULL, '2023-08-21 00:00:52', '2023-08-21 00:00:52'),
(7, 'Hello Benny and warren', NULL, '2023-08-21 00:03:20', '2023-08-21 00:03:20'),
(8, 'Marry Wills', NULL, '2023-08-21 21:11:49', '2023-08-21 21:11:49'),
(9, 'James', NULL, '2023-08-21 22:53:31', '2023-08-21 22:53:31'),
(10, 'Teena', NULL, '2023-08-23 00:15:17', '2023-08-23 00:15:17');

-- Creating primary key index for table `users`
CREATE INDEX idx_users_id ON users (id);
