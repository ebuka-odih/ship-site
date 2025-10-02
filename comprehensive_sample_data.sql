-- Comprehensive Sample Shipment Data for Testing
-- This creates multiple shipments with different statuses and histories
-- Ensure we have a user
INSERT IGNORE INTO users (
        id,
        name,
        email,
        password,
        role,
        email_verified_at,
        created_at,
        updated_at
    )
VALUES (
        1,
        'Test User',
        'test@example.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'user',
        NOW(),
        NOW(),
        NOW()
    );
-- Sample Shipment 1: In Transit
INSERT INTO shipments (
        tracking_number,
        status,
        user_id,
        shipper_name,
        shipper_phone,
        shipper_address,
        shipper_email,
        receiver_name,
        receiver_phone,
        receiver_address,
        receiver_email,
        agent_name,
        type_of_shipment,
        weight,
        courier,
        packages,
        mode,
        product,
        quantity,
        payment_mode,
        total_freight,
        carrier,
        carrier_reference_no,
        departure_time,
        origin,
        destination,
        pickup_date,
        pickup_time,
        expected_delivery_date,
        comments,
        created_at,
        updated_at
    )
VALUES (
        'SH65A1B2C3D4E5F',
        'in_transit',
        1,
        'John Smith',
        '+1-555-0123',
        '123 Main Street, New York, NY 10001, USA',
        'john.smith@email.com',
        'Sarah Johnson',
        '+1-555-0456',
        '456 Oak Avenue, Los Angeles, CA 90210, USA',
        'sarah.johnson@email.com',
        'Mike Wilson',
        'Documents',
        '2.5 kg',
        'Express Delivery',
        '1',
        'Air',
        'Legal Documents',
        '1',
        'Prepaid',
        '$125.50',
        'FedEx',
        'FX123456789',
        '14:30:00',
        'New York, NY',
        'Los Angeles, CA',
        DATE_SUB(NOW(), INTERVAL 3 DAY),
        '09:00:00',
        DATE_ADD(NOW(), INTERVAL 1 DAY),
        'Fragile documents - handle with care',
        NOW(),
        NOW()
    );
-- Sample Shipment 2: Delivered
INSERT INTO shipments (
        tracking_number,
        status,
        user_id,
        shipper_name,
        shipper_phone,
        shipper_address,
        shipper_email,
        receiver_name,
        receiver_phone,
        receiver_address,
        receiver_email,
        agent_name,
        type_of_shipment,
        weight,
        courier,
        packages,
        mode,
        product,
        quantity,
        payment_mode,
        total_freight,
        carrier,
        carrier_reference_no,
        departure_time,
        origin,
        destination,
        pickup_date,
        pickup_time,
        expected_delivery_date,
        comments,
        created_at,
        updated_at
    )
VALUES (
        'SH78B9C0D1E2F3G',
        'delivered',
        1,
        'Alice Brown',
        '+1-555-0789',
        '789 Pine Street, Chicago, IL 60601, USA',
        'alice.brown@email.com',
        'Bob Davis',
        '+1-555-0123',
        '321 Elm Street, Miami, FL 33101, USA',
        'bob.davis@email.com',
        'Lisa Garcia',
        'Electronics',
        '5.2 kg',
        'Standard Delivery',
        '2',
        'Ground',
        'Laptop Computer',
        '1',
        'COD',
        '$89.99',
        'UPS',
        'UPS987654321',
        '10:15:00',
        'Chicago, IL',
        'Miami, FL',
        DATE_SUB(NOW(), INTERVAL 7 DAY),
        '08:30:00',
        DATE_SUB(NOW(), INTERVAL 1 DAY),
        'Handle with care - electronics',
        DATE_SUB(NOW(), INTERVAL 7 DAY),
        NOW()
    );
-- Sample Shipment 3: Pending
INSERT INTO shipments (
        tracking_number,
        status,
        user_id,
        shipper_name,
        shipper_phone,
        shipper_address,
        shipper_email,
        receiver_name,
        receiver_phone,
        receiver_address,
        receiver_email,
        agent_name,
        type_of_shipment,
        weight,
        courier,
        packages,
        mode,
        product,
        quantity,
        payment_mode,
        total_freight,
        carrier,
        carrier_reference_no,
        departure_time,
        origin,
        destination,
        pickup_date,
        pickup_time,
        expected_delivery_date,
        comments,
        created_at,
        updated_at
    )
VALUES (
        'SH91C2D3E4F5G6H',
        'pending',
        1,
        'Emma Wilson',
        '+1-555-0456',
        '456 Oak Avenue, Seattle, WA 98101, USA',
        'emma.wilson@email.com',
        'David Miller',
        '+1-555-0789',
        '654 Maple Drive, Portland, OR 97201, USA',
        'david.miller@email.com',
        'Tom Anderson',
        'Clothing',
        '1.8 kg',
        'Economy Delivery',
        '1',
        'Ground',
        'Winter Jacket',
        '1',
        'Prepaid',
        '$45.75',
        'USPS',
        'USPS456789123',
        '16:45:00',
        'Seattle, WA',
        'Portland, OR',
        DATE_ADD(NOW(), INTERVAL 1 DAY),
        '10:00:00',
        DATE_ADD(NOW(), INTERVAL 3 DAY),
        'Weather-resistant packaging required',
        NOW(),
        NOW()
    );
-- Get shipment IDs
SET @shipment1_id = (
        SELECT id
        FROM shipments
        WHERE tracking_number = 'SH65A1B2C3D4E5F'
    );
SET @shipment2_id = (
        SELECT id
        FROM shipments
        WHERE tracking_number = 'SH78B9C0D1E2F3G'
    );
SET @shipment3_id = (
        SELECT id
        FROM shipments
        WHERE tracking_number = 'SH91C2D3E4F5G6H'
    );
-- History for Shipment 1 (In Transit)
INSERT INTO shipment_histories (
        shipment_id,
        status,
        location,
        note,
        updated_by,
        remarks,
        created_at,
        updated_at
    )
VALUES (
        @shipment1_id,
        'Shipment Created',
        'New York, NY',
        'Shipment created and ready for pickup',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 3 DAY, 2 HOUR),
        DATE_SUB(NOW(), INTERVAL 3 DAY, 2 HOUR)
    ),
    (
        @shipment1_id,
        'Picked Up',
        'New York, NY',
        'Package picked up from sender',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 3 DAY),
        DATE_SUB(NOW(), INTERVAL 3 DAY)
    ),
    (
        @shipment1_id,
        'In Transit',
        'New York Hub',
        'Package arrived at origin hub',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR),
        DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR)
    ),
    (
        @shipment1_id,
        'In Transit',
        'Chicago Hub',
        'Package in transit to destination',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 1 DAY, 8 HOUR),
        DATE_SUB(NOW(), INTERVAL 1 DAY, 8 HOUR)
    ),
    (
        @shipment1_id,
        'Out for Delivery',
        'Los Angeles Hub',
        'Package arrived at destination hub and out for delivery',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 2 HOUR),
        DATE_SUB(NOW(), INTERVAL 2 HOUR)
    );
-- History for Shipment 2 (Delivered)
INSERT INTO shipment_histories (
        shipment_id,
        status,
        location,
        note,
        updated_by,
        remarks,
        created_at,
        updated_at
    )
VALUES (
        @shipment2_id,
        'Shipment Created',
        'Chicago, IL',
        'Shipment created and ready for pickup',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 7 DAY, 1 HOUR),
        DATE_SUB(NOW(), INTERVAL 7 DAY, 1 HOUR)
    ),
    (
        @shipment2_id,
        'Picked Up',
        'Chicago, IL',
        'Package picked up from sender',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 7 DAY),
        DATE_SUB(NOW(), INTERVAL 7 DAY)
    ),
    (
        @shipment2_id,
        'In Transit',
        'Chicago Hub',
        'Package arrived at origin hub',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 6 DAY, 2 HOUR),
        DATE_SUB(NOW(), INTERVAL 6 DAY, 2 HOUR)
    ),
    (
        @shipment2_id,
        'In Transit',
        'Atlanta Hub',
        'Package in transit to destination',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 4 DAY, 6 HOUR),
        DATE_SUB(NOW(), INTERVAL 4 DAY, 6 HOUR)
    ),
    (
        @shipment2_id,
        'In Transit',
        'Miami Hub',
        'Package arrived at destination hub',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR),
        DATE_SUB(NOW(), INTERVAL 2 DAY, 4 HOUR)
    ),
    (
        @shipment2_id,
        'Out for Delivery',
        'Miami, FL',
        'Package out for delivery',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 1 DAY, 2 HOUR),
        DATE_SUB(NOW(), INTERVAL 1 DAY, 2 HOUR)
    ),
    (
        @shipment2_id,
        'Delivered',
        'Miami, FL',
        'Package successfully delivered to recipient',
        1,
        'System generated',
        DATE_SUB(NOW(), INTERVAL 1 DAY),
        DATE_SUB(NOW(), INTERVAL 1 DAY)
    );
-- History for Shipment 3 (Pending)
INSERT INTO shipment_histories (
        shipment_id,
        status,
        location,
        note,
        updated_by,
        remarks,
        created_at,
        updated_at
    )
VALUES (
        @shipment3_id,
        'Shipment Created',
        'Seattle, WA',
        'Shipment created and pending pickup',
        1,
        'System generated',
        NOW(),
        NOW()
    );
-- Display results
SELECT 'Sample shipments created successfully!' as message,
    '3' as total_shipments,
    'SH65A1B2C3D4E5F' as tracking_1,
    'SH78B9C0D1E2F3G' as tracking_2,
    'SH91C2D3E4F5G6H' as tracking_3;