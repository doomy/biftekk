CREATE TABLE IF NOT EXISTS upgrade_history (id INT, message TEXT);
CREATE TABLE IF NOT EXISTS events (
    id          INT NOT NULL AUTO_INCREMENT,
    filename    VARCHAR(255),
    date        DATE,
    PRIMARY KEY(id)
);
