CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    department TEXT NOT NULL,
    role TEXT CHECK(role IN ('STAFF', 'HOD', 'REGISTRAR', 'Manager', 'ADMIN')) NOT NULL
);

CREATE TABLE events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    event_name TEXT NOT NULL,
    event_start_date DATE NOT NULL,
    event_end_date DATE,
    event_time_from TIME NOT NULL,
    event_time_to TIME NOT NULL,
    event_details TEXT,
    event_conducted BOOLEAN DEFAULT 0,
    incharge_name TEXT NOT NULL,
    incharge_no TEXT NOT NULL,
    incharge_department TEXT NOT NULL
);

CREATE TABLE bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    hall_id INTEGER NOT NULL,
    facilities_ids TEXT,
    purpose_of_hall TEXT,
    seating_capacity_required INTEGER NOT NULL,
    booking_date DATE NOT NULL,
    event_time_from TIME NOT NULL,
    event_time_to TIME NOT NULL,
    booking_number TEXT NOT NULL UNIQUE,
    FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (hall_id) REFERENCES halls(id)
);

CREATE TABLE halls (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    hall_name TEXT NOT NULL,
    location TEXT NOT NULL,
    seating_capacity INTEGER NOT NULL
);

CREATE TABLE facilities (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    facility_name TEXT NOT NULL,
    description TEXT
);


INSERT INTO halls (hall_name, location, seating_capacity) VALUES
('K. S. Krishnan Auditorium', 'Main Building', 500),
('Dr. V. Vasudevan Seminar Hall', 'Science Block', 150),
('Admin Block Seminar Hall', 'Admin Block', 100),
('Srinivasa Ramanujam Block Seminar Hall', 'Mathematics Wing', 120),
('Dr. A. P. J. Abdul Kalam Block Seminar Hall', 'Engineering Block', 200),
('Dr. S. Radha Krishnan Senate Hall', 'Senate Building', 300);



INSERT INTO facilities (facility_name, description) VALUES
('Projector', 'HD projector for presentations'),
('Sound System', 'Speakers and microphones for events'),
('Wi-Fi', 'High-speed internet connectivity'),
('Whiteboard', 'Whiteboard with markers');
('Reception Item', 'Reception Item');
('Power Backup', 'Power backup');
('Audio','Audio');


INSERT INTO users (username, password, department, role) VALUES
('john_doe', 'password123', 'IT', 'STAFF'),
('jane_smith', 'password456', 'ECE', 'HOD'),
('alice_jones', 'password789', 'Registrar', 'REGISTRAR'),
('michael_brown', 'securepass', 'Management', 'Manager'),
('admin_user', 'adminpass', 'Admin', 'ADMIN');
