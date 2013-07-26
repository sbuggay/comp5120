DROP TABLE Room CASCADE;
DROP TABLE Bed CASCADE;
DROP TABLE Insurance CASCADE;
DROP TABLE EmployeeCost CASCADE;
DROP TABLE Patient CASCADE;
DROP TABLE TreatmentType CASCADE;
DROP TABLE Treatment CASCADE;
DROP TABLE Doctor CASCADE;
DROP TABLE TreatmentInvolvement CASCADE;
DROP TABLE RoomCost CASCADE;

CREATE TABLE RoomCost(
	roomName varchar(20) NOT NULL,
	roomCost integer,
	numBeds smallint,
	PRIMARY KEY (roomName)
	);

CREATE TABLE Room(
	roomID integer NOT NULL,
	roomName varchar(20),
	FOREIGN KEY (roomName) REFERENCES RoomCost(roomName),
	PRIMARY KEY (roomID)
	);

CREATE TABLE Doctor(
	DoctorID smallint NOT NULL,
	name varchar(30),
	phone varchar(15),
	office int,
	PRIMARY KEY (DoctorID)
	);

CREATE TABLE Bed(
	roomID integer NOT NULL,
	bedLabel varchar(1) NOT NULL,
	PRIMARY KEY (roomID,bedLabel),
	FOREIGN KEY (roomID) REFERENCES Room(roomID)
	);

CREATE TABLE Insurance(
	InsuranceName varchar(21) NOT NULL,
	phone varchar(20),
	PRIMARY KEY (insuranceName)
	);

CREATE TABLE EmployeeCost(
	employeeType varchar(20),
	cost smallint,
	PRIMARY KEY (employeeType)
	);

CREATE TABLE Patient(
	patientID smallint NOT NULL,
	name varchar(30),
	addrStreet varchar(50),
	addrCity varchar(25),
	addrState varchar(15),
	addrZIP integer,
	admitted date,
	discharged date,
	doctorID smallint,
	insuranceName varchar(20),
	policynum varchar(20),
	roomID integer,
	bedLabel varchar(1),
	PRIMARY KEY (patientID),
	FOREIGN KEY (roomID, bedLabel) REFERENCES Bed (RoomID, bedLabel),
	FOREIGN KEY (insuranceName) REFERENCES Insurance (insuranceName),
	FOREIGN KEY (doctorID) REFERENCES Doctor (DoctorID),
	UNIQUE (roomID,bedLabel)
	);

CREATE TABLE TreatmentType(
	TreatmentType varchar(20) NOT NULL,
	cost smallint,
	ordered boolean,
	PRIMARY KEY (TreatmentType)
	);

CREATE TABLE Treatment(
	TreatmentID smallint NOT NULL,
	TreatmentType varchar(20) NOT NULL,
	doctorID smallint,
	patientID smallint NOT NULL,
	duration smallint,
	PRIMARY KEY (TreatmentID),
	FOREIGN KEY (patientID) REFERENCES Patient (PatientID),
	FOREIGN KEY (TreatmentType) REFERENCES TreatmentType (TreatmentType),
	FOREIGN KEY (doctorID) REFERENCES Doctor(DoctorID) 
	);

CREATE TABLE TreatmentInvolvement(
	TreatmentID smallint NOT NULL,
	EmployeeType varchar(20) NOT NULL,
	Count smallint,
	PRIMARY KEY (TreatmentID, EmployeeType),
	FOREIGN KEY (EmployeeType) REFERENCES EmployeeCost(EmployeeType),
	FOREIGN KEY (TreatmentID) REFERENCES Treatment(TreatmentID)
);

INSERT INTO TreatmentType VALUES
('Surgery1',10000,true),
('Surgery2',7000,true),
('Outpatient1',1500,true),
('Outpatient2',900,true),
('Outpatient3',500,true),
('PhysTherapy',300,true),
('XRay',200,true),
('BloodTest',75,true),
('RespTherapy',200,true),
('RoomVisit',50,false),
('AttendantCare',50,false),
('DrConsult',100,true)
;	

INSERT INTO EmployeeCost VALUES
('Doctor', 300),
('Nurse', 150),
('Technician', 75),
('Staff', 25)
;

INSERT INTO RoomCost VALUES
('Private',1000,1),
('SemiPrivate',500,2)
;

INSERT INTO Room VALUES
(100, 'Private'),
(101, 'Private'),
(102, 'SemiPrivate'),
(103, 'SemiPrivate'),
(104, 'SemiPrivate'),
(200, 'Private'),
(201, 'SemiPrivate'),
(202, 'SemiPrivate'),
(203, 'SemiPrivate'),
(204, 'SemiPrivate')
;

INSERT INTO Bed VALUES
(100, 'A'),
(101, 'A'),
(102, 'A'),
(102, 'B'),
(103, 'A'),
(103, 'B'),
(104, 'A'),
(104, 'B'),
(200, 'A'),
(201, 'A'),
(201, 'B'),
(202, 'A'),
(202, 'B'),
(203, 'A'),
(203, 'B'),
(204, 'A'),
(204, 'B')
;

INSERT INTO Insurance VALUES
('Medicare', '000 000 0000'),
('Medicaid', '000 000 0000'),
('Unitedhealth Group', '000 000 0000'),
('Wellpoint Inc. Group', '000 000 0000')
;

INSERT INTO Doctor VALUES
(1, 'Dr. Hendrix', '027-5874', 500),
(2, 'Dr. Andrews', '171-9239', 501),
(3, 'Dr. Owen', '201-1023', 502),
(4, 'Dr. Fry', '922-1415', 503)
;

INSERT INTO Patient VALUES
(1, 'Eric Kitaif', '5 Haley Ave', 'Auburn', 'Alabama', 35213, '7/22/2013', NULL, 1, 'Medicare', '115', 100, 'A'),
(2, 'Justin Brewer', '20 Shelby Way', 'Auburn', 'Alabama', 35213, '7/20/2013', '7/21/2013', 1, 'Medicaid', '215', 102, 'A'),
(3, 'Devan Buggay', '6 Broun St', 'Auburn', 'Alabama', 35213, '7/24/2013', NULL, 1, 'Unitedhealth Group', '3215', 200, 'A'),
(4, 'Zach White', '34 Parker Ave', 'Auburn', 'Alabama', 35213, '7/21/2013', '7/22/2013', 1, 'Wellpoint Inc. Group', '3235', 204, 'A'),
(5, 'Pam Zirkle', '3 Parker Ave', 'Auburn', 'Alabama', 35213, '7/21/2013', '7/22/2013', 1, 'Medicare', '3235', 204, 'B'),
(6, 'Mina Edgar', '5 College Ave', 'Auburn', 'Alabama', 35213, '7/22/2013', '7/24/2013', 1, 'Wellpoint Inc. Group', '3235', 202, 'A')
;


INSERT INTO treatment VALUES 
(1, 'Surgery1', 1, 1, 4),
(2, 'Surgery2', 2, 2, 4),
(3, 'XRay', 3, 3, 4),
(4, 'Surgery1', 3, 4, 4),
(5, 'XRay', 1, 1, 1)
;


INSERT INTO treatmentinvolvement VALUES 
(1, 'Doctor', 2),
(1, 'Nurse', 4),
(2, 'Doctor', 1),
(2, 'Nurse', 2),
(3, 'Technician', 1),
(3, 'Staff', 2),
(4, 'Doctor', 1),
(4, 'Nurse', 3),
(5, 'Technician', 2),
(5, 'Staff', 3),
(5, 'Nurse', 1)
;