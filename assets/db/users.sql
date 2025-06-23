CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    rolle TEXT DEFAULT 'user',
    profile_picture TEXT,
    pref_color TEXT,
    theme TEXT
);
