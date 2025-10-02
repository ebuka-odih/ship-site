-- Step-by-step setup for sample shipment data
-- Run these commands in order in your cPanel database

-- Step 1: Create the shipment_histories table first
CREATE TABLE IF NOT EXISTS `shipment_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shipment_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment_histories_shipment_id_foreign` (`shipment_id`),
  KEY `shipment_histories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `shipment_histories_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `shipment_histories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step 2: Ensure we have a user
INSERT IGNORE INTO users (id, name, email, password, role, email_verified_at, created_at, updated_at) 
VALUES (1, 'Test User', 'test@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NOW(), NOW(), NOW());

-- Step 3: Create sample shipments
INSERT INTO shipments (
    tracking_number, status, user_id,
    shipper_name, shipper_phone, shipper_address, shipper_email,
    receiver_name, receiver_phone, receiver_address, receiver_email,
    agent_name, type_of_shipment, weight, courier, packages, mode, product, quantity,
    payment_mode, total_freight,
    carrier, carrier_reference_no,
    departure_time, origin, destination, pickup_date, pickup_time, expected_delivery_date,
    comments, created_at, updated_at
) VALUES (
    'SH65A1B2C3D4E5F', 'in_transit', 1,
    'John Smith', '+1-555-0123', '123 Main Street, New York, NY 10001, USA', 'john.smith@email.com',
    'Sarah Johnson', '+1-555-0456', '456 Oak Avenue, Los Angeles, CA 90210, USA', 'sarah.johnson@email.com',
    'Mike Wilson', 'Documents', '2.5 kg', 'Express Delivery', '1', 'Air', 'Legal Documents', '1',
    'Prepaid', '$125.50',
    'FedEx', 'FX123456789',
    '14:30:00', 'New York, NY', 'Los Angeles, CA', DATE_SUB(NOW(), INTERVAL 3 DAY), '09:00:00', DATE_ADD(NOW(), INTERVAL 1 DAY),
    'Fragile documents - handle with care', NOW(), NOW()
);

-- Step 4: Get the shipment ID and create history
SET @shipment_id = LAST_INSERT_ID();

-- Step 5: Create shipment history entries
INSERT INTO shipment_histories (shipment_id, status, location, note, updated_by, remarks, created_at, updated_at) VALUES
(@shipment_id, 'Shipment Created', 'New York, NY', 'Shipment created and ready for pickup', 1, 'System generated', DATE_SUB(NOW(), INTERVAL 3 DAY, 2 HOUR), DATE_SUB(NOW(), INTERVAL 3 DAY, 2 HOUR)),
(@shipment_id, 'Picked Up', 'New York, NY', 'Package picked up from sender', 1, 'System generated', DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY)),
(@shipment_id, 'In Transit', 'New York Hub', 'Package arrived at origin hub', 1, 'System generated', DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR), DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR)),
(@shipment_id, 'In Transit', 'Chicago Hub', 'Package in transit to destination', 1, 'System generated', DATE_SUB(NOW(), INTERVAL 1 DAY, 8 HOUR), DATE_SUB(NOW(), INTERVAL 1 DAY, 8 HOUR)),
(@shipment_id, 'Out for Delivery', 'Los Angeles Hub', 'Package arrived at destination hub and out for delivery', 1, 'System generated', DATE_SUB(NOW(), INTERVAL 2 HOUR), DATE_SUB(NOW(), INTERVAL 2 HOUR));

-- Step 6: Display success message
SELECT 'Sample shipment created successfully!' as message,
       'SH65A1B2C3D4E5F' as tracking_number,
       'in_transit' as status,
       '5' as history_entries;
