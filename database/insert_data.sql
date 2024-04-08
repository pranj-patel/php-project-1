-- Insert data into the 'users' table
INSERT INTO users (name, created_at, updated_at)
VALUES
    ('Harry', datetime('now'), datetime('now')),
    ('Sonu', datetime('now'), datetime('now')),
    ('John', datetime('now'), datetime('now')),
    ('Sam', datetime('now'), datetime('now')),
    ('Warren', datetime('now'), datetime('now')),
    ('Benny', datetime('now'), datetime('now')),
    ('Hello Benny and warren', datetime('now'), datetime('now')),
    ('Marry Wills', datetime('now'), datetime('now')),
    ('James', datetime('now'), datetime('now')),
    ('Teena', datetime('now'), datetime('now'));

-- Insert data into the 'posts' table
INSERT INTO posts (title, message, user_id, created_at, updated_at)
VALUES
    ('Exploring Nature''s Beauty', 'Took a hike today and captured the stunning landscapes. Nature never fails to amaze me!', 1, datetime('now'), datetime('now')),
    ('Trying Out a New Recipe', 'Cooked a delicious homemade lasagna today. It''s all about experimenting in the kitchen!', 1, datetime('now'), datetime('now')),
    ('Weekend Coding Marathon', 'Spent the entire weekend coding a new feature for my app. Dedication pays off!', 1, datetime('now'), datetime('now')),
    ('Startup Journey Update', '🚀 Greetings, fellow adventurers of the entrepreneurial realm!...', 1, datetime('now'), datetime('now')),
    ('Book Recommendations Needed updated','📚 Hello fellow book enthusiasts!...', 1, datetime('now'), datetime('now'));

-- Insert data into the 'comments' table
INSERT INTO comments (post_id, user_id, comment_id, reply_to_id, comment, user_name, created_at, updated_at)
VALUES
    (2, 5, 0, 0, 'I can almost smell that lasagna through the screen! Recipe please?', 'Warren', datetime('now'), datetime('now')),
    (2, 4, 1, 0, 'Test Comment', 'Sam', datetime('now'), datetime('now')),
    (2, 6, 1, 3, 'Absolutely, UserZ! Start with simple recipes and don&#039;t be afraid to make mistakes.', 'Benny', datetime('now'), datetime('now')),
    (2, 6, 1, 0, 'Hello Warren', 'Benny', datetime('now'), datetime('now')),
    (2, 3, 1, 5, 'Hello Banny and John', 'John', datetime('now'), datetime('now')),
    (5, 8, 0, 0, 'Hi what a beautiful collection! Really loved it ❤', 'Marry Wills', datetime('now'), datetime('now')),
    (5, 8, 0, 0, 'Loved it!', 'Marry Wills', datetime('now'), datetime('now')),
    (5, 9, 0, 0, 'Very Beautiful', 'James', datetime('now'), datetime('now')),
    (5, 9, 8, 0, 'Thanks', 'James', datetime('now'), datetime('now')),
    (5, 9, 8, 0, 'Thanks', 'James', datetime('now'), datetime('now')),
    (5, 9, 8, 0, 'Nice', 'James', datetime('now'), datetime('now')),
    (5, 9, 10, 0, 'Great', 'James', datetime('now'), datetime('now')),
    (5, 9, 8, 12, 'hello', 'James', datetime('now'), datetime('now')),
    (5, 10, 0, 0, 'test comment', 'Teena', datetime('now'), datetime('now'));

-- Insert data into the 'likes' table
INSERT INTO likes (post_id, user_id, created_at, updated_at)
VALUES
    (5, 1, datetime('now'), datetime('now')),
    (5, 9, datetime('now'), datetime('now')),
    (2, 9, datetime('now'), datetime('now')),
    (4, 1, datetime('now'), datetime('now')),
    (5, 10, datetime('now'), datetime('now'));