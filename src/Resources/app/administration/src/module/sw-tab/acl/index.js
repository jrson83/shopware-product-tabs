Shopware.Service('privileges').addPrivilegeMappingEntry({
    category: 'permissions',
    parent: 'catalogues',
    key: 'tab',
    roles: {
        viewer: {
            privileges: [
                'tab:read',
                'tab_translation:read',
                'product_tab:read',
            ],
            dependencies: [],
        },
        editor: {
            privileges: [
                'tab:update',
                'tab_translation:update',
                'product_tab:update',
            ],
            dependencies: ['tab.viewer'],
        },
        creator: {
            privileges: [
                'tab:create',
                'tab_translation:create',
                'product_tab:create',
            ],
            dependencies: ['tab.viewer', 'tab.editor'],
        },
        deleter: {
            privileges: [
                'tab:delete',
                'tab_translation:delete',
                'product_tab:delete',
            ],
            dependencies: ['tab.viewer'],
        },
    },
})
