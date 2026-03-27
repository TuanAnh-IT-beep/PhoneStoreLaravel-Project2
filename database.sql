USE bmobileshop;
INSERT INTO permissions (id, name, description) VALUES
(1, 'manage_users', 'Manage Users'),
(2, 'manage_products', 'Manage Products'),
(3, 'manage_orders', 'Manage Orders');
(4, 'manage_customers', 'Manage Customers');

INSERT INTO roles (id, name) VALUES
(1, 'Admin'),
(2, 'Product Manager'),
(3, 'Order Manager');

INSERT INTO role_permissions (role_id, permission_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(3, 3);
(3, 4);


