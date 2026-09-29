ALTER TABLE blogs ADD COLUMN card_heading VARCHAR(255) DEFAULT '' AFTER metadesc;
ALTER TABLE blogs ADD COLUMN card_data LONGTEXT DEFAULT '' AFTER card_heading;
