CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password_hash VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    amount_of_workouts VARCHAR(100)
);

CREATE TABLE Locations (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255),
    maps_link VARCHAR(500) COMMENT 'Google Maps URL for the location',
    image_path VARCHAR(255) COMMENT 'Path to the location image',
    parking_available VARCHAR(100)
);

CREATE TABLE ContactMe (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL, 
    message TEXT,
    name VARCHAR(100),
    email VARCHAR(100),
    subject TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE SET NULL
);

CREATE TABLE Subscriptions (
    subscription_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    duration INT COMMENT 'Duration in months',
    price DECIMAL(10,2),
    workouts_included INT,
    benefits TEXT
);

CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    chosen_course_subscription VARCHAR(100),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

ALTER TABLE Payments
ADD subscription_id INT,
ADD FOREIGN KEY (subscription_id) REFERENCES Subscriptions(subscription_id) ON DELETE CASCADE;

ALTER TABLE Payments
ADD course_id INT,
ADD FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE;

CREATE TABLE Location_Courses (
    location_id INT,
    course_id INT,
    PRIMARY KEY (location_id, course_id),
    FOREIGN KEY (location_id) REFERENCES Locations(location_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);
