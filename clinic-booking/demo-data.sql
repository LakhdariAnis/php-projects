-- Fake demo appointments so the dashboard is not empty. All names, phones and emails are invented.
USE damsmsdb;

INSERT INTO tblappointment (AppointmentNumber, Name, MobileNumber, Email, AppointmentDate, AppointmentTime, Specialization, Doctor, Status, Remark) VALUES
('482913057', 'Yacine Demo',  550000101, 'yacine@example.com',  CURDATE(), '09:00:00', '1', 11, NULL, NULL),
('593024168', 'Sara Demo',    550000102, 'sara@example.com',    CURDATE(), '09:30:00', '1', 11, 'Approved', 'Bring previous X-ray'),
('604135279', 'Karim Demo',   550000103, 'karim@example.com',   CURDATE(), '10:30:00', '1', 11, NULL, NULL),
('715246380', 'Lina Demo',    550000104, 'lina@example.com',    CURDATE() + INTERVAL 1 DAY, '11:00:00', '1', 11, NULL, NULL),
('826357491', 'Amine Demo',   550000105, 'amine@example.com',   CURDATE() + INTERVAL 1 DAY, '14:00:00', '1', 11, 'Approved', 'Follow-up visit'),
('937468502', 'Nadia Demo',   550000106, 'nadia@example.com',   CURDATE() + INTERVAL 3 DAY, '09:00:00', '1', 11, NULL, NULL),
('148579613', 'Riad Demo',    550000107, 'riad@example.com',    CURDATE() - INTERVAL 2 DAY, '15:00:00', '1', 11, 'Cancelled', 'Patient cancelled'),
('259680724', 'Meriem Demo',  550000108, 'meriem@example.com',  CURDATE() - INTERVAL 5 DAY, '10:00:00', '1', 11, 'Approved', 'Done'),
('360791835', 'Walid Demo',   550000109, 'walid@example.com',   CURDATE() + INTERVAL 2 DAY, '10:00:00', '2', 12, NULL, NULL);

INSERT INTO tblchat (AppointmentID, SenderType, SenderName, Message, IsRead) VALUES
((SELECT ID FROM tblappointment WHERE AppointmentNumber = '593024168'), 'patient', 'Sara Demo', 'Hello doctor, should I bring my old X-ray?', 1),
((SELECT ID FROM tblappointment WHERE AppointmentNumber = '593024168'), 'doctor', 'Dr. Mohamed', 'Yes please, and arrive 10 minutes early.', 1),
((SELECT ID FROM tblappointment WHERE AppointmentNumber = '482913057'), 'patient', 'Yacine Demo', 'Can I come at 9:15 instead?', 0);
