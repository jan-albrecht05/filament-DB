CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    rolle TEXT DEFAULT 'user',
    profile_picture TEXT,
    pref_color TEXT,
    theme TEXT
);

insert into users (username, password, rolle, profile_picture, pref_color, theme) values
('admin', 'admin', 'admin', 'assets/img/uploads/users/admin.png', '#ff0000', 'dark'),
('user', 'user', 'user', 'assets/img/uploads/users/user.png', '#00ff00', 'dark')