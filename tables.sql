DROP TABLE Room CASCADE;
DROP TABLE Bed CASCADE;
DROP TABLE Insurance CASCADE;
DROP TABLE EmployeeCost CASCADE;
DROP TABLE Patient CASCADE;
DROP TABLE TreatmentType CASCADE;
DROP TABLE Treatment CASCADE;
DROP TABLE Doctor CASCADE;
DROP TABLE TreatmentInvolvement CASCADE;

CREATE TABLE Room(
        roomID integer NOT NULL,
        roomPrivate boolean,
        numBeds smallint,
        Cost smallint,
	PRIMARY KEY (roomID)
        );

CREATE TABLE Doctor(
	DoctorID smallint NOT NULL,
	name varchar(30),
	phone varchar(15),
	PRIMARY KEY (DoctorID)
	);

CREATE TABLE Bed(
        roomID integer NOT NULL,
        bedLabel varchar(1) NOT NULL,
        PRIMARY KEY (roomID,bedLabel),
        FOREIGN KEY (roomID) REFERENCES Room(roomID)
        );

CREATE TABLE Insurance(
	InsuranceName varchar(20) NOT NULL,
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
	addrZIP smallint,
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
	FOREIGN KEY (doctorID) REFERENCES Doctor (DoctorID)
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
	('DrConsult',100,true),
	('PrivateRoom',1000,false),
	('SemiPrivateRoom',500,false)
;	

INSERT INTO EmployeeCost VALUES
	('Doctor', 300),
	('Nurse', 150),
	('Technician', 75),
	('Staff', 25)
;