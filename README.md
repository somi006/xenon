# xenon
<!-- Usage -->
# This project can be used to Login a user, Register a user and Create a request using the Contact us page.

<!-- Create user table -->
CREATE TABLE users (
    id int not null AUTO_INCREMENT,
    full_name varchar(255) null,
    email varchar(255) null,
    password varchar(255) null,
    status tinyint(1) null COMMENT "'0' = 'Inactive', '1' = 'Active'",
    updated_at datetime null ON UPDATE CURRENT_TIMESTAMP(),
    deleted_at datetime null,
    created_at datetime null DEFAULT current_timestamp(),
    PRIMARY KEY (id)
);

<!-- Registration -->
# Fill the required fields to register a new user

<!-- Login -->
# Enter Email and password to Login which you have created during registration

<!-- Contact us -->
# This can be used to create a request regarding the issues and the to give the feedback.