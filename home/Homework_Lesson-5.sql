CREATE TABLE malumotlar (
    id SERIAL PRIMARY KEY,
    malumot TEXT,
    num INT,
    timestamp TIMESTAMP,
    timestamptz TIMESTAMPTZ
);

INSERT INTO malumotlar (malumot, num, timestamp, timestamptz)
VALUES
    ('Message...1', 25, '2023-12-01 10:30:00', '2023-12-01 10:30:00+05:00'),
    ('Message...2', 30, '2023-12-01 12:45:00', '2023-12-01 7:45:00+05:00'),
    ('Message...3', 22, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...4', 34, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...5', 56, '2023-12-01 6:20:00', '2023-12-01 6:20:00+05:00'),
    ('Message...6', 76, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...7', 22, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...8', 86, '2023-12-01 4:20:00', '2023-12-01 5:20:00+05:00'),
    ('Message...9', 65, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...10', 12, '2023-12-01 2:20:00', '2023-12-01 5:20:00+05:00'),
    ('Message...11', 24, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00'),
    ('Message...12', 45, '2023-12-01 15:20:00', '2023-12-01 15:20:00+05:00');	

SELECT *
FROM malumotlar
WHERE EXTRACT(HOUR FROM timestamp) BETWEEN 8 AND 18
   OR EXTRACT(HOUR FROM timestamptz) BETWEEN 8 AND 18;
