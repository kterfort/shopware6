Shopware.Service('privileges')
    .addPrivilegeMappingEntry({
        category: 'additional_permissions',
        parent: null,
        key: 'orders',
        roles: {
            create_discounts: {
                privileges: ['order:create:discount'],
                dependencies: [],
            },
        },
    })
    .addPrivilegeMappingEntry({
        category: 'permissions',
        parent: 'orders',
        key: 'order',
        roles: {
            viewer: {
                privileges: [
                    'order:read',
                    'order_address:read',
                    'sales_channel:read',
                    'order_customer:read',
                    'currency:read',
                    'document:read',
                    'order_transaction:read',
                    'order_delivery:read',
                    'order_line_item:read',
                    'shipping_method:read',
                    'mail_template_sales_channel:read',
                    'mail_template_type:read',
                    'country:read',
                    'country_state:read',
                    'payment_method:read',
                    'document_type:read',
                    'tag:read',
                    'custom_field_set:read',
                    'custom_field:read',
                    'custom_field_set_relation:read',
                    'state_machine_history:read',
                    'state_machine:read',
                    'state_machine_state:read',
                    'user:read',
                    'user_config:read',
                    'user_config:create',
                    'user_config:update',
                ],
                dependencies: [],
            },
            editor: {
                privileges: [
                    'mail_template:read',
                    'state_machine_history:create',
                    'mail_template_sales_channel:create',
                    'document:update',
                    'document:create',
                    'order:update',
                    'order_customer:update',
                    'tag:create',
                    'order_address:update',
                    'order_delivery:update',
                    'product:read',
                    'property_group_option:read',
                    'property_group:read',
                    'product_visibility:read',
                    'order_line_item:update',
                    'order_line_item:create',
                    'customer:read',
                    'customer_address:read',
                    'salutation:read',
                    'order_address:create',
                    'order:delete',
                ],
                dependencies: [
                    'order.viewer',
                ],
            },
            creator: {
                privileges: [
                    'customer_group:read',
                    'order:create',
                    'order_customer:create',
                    'order_delivery:create',
                    'order_line_item:create',
                    'order_transaction:create',
                    'order_delivery_position:create',
                    'mail_template_type:update',
                    'customer:update',
                ],
                dependencies: [
                    'order.viewer',
                    'order.editor',
                ],
            },
            deleter: {
                privileges: [
                    'order:delete',
                ],
                dependencies: [
                    'order.viewer',
                ],
            },
        },
    });