import './acl'
import defaultSearchConfiguration from './default-search-configuration'
import deDE from './snippet/de-DE'
import enGB from './snippet/en-GB'

const { Module } = Shopware

Shopware.Component.register('sw-tab-list', () => import('./page/sw-tab-list'))
Shopware.Component.register(
    'sw-tab-detail',
    () => import('./page/sw-tab-detail')
)

Module.register('sw-tab', {
    type: 'plugin',
    name: 'tab',
    title: 'sw-tab.general.mainMenuItemGeneral',
    description: 'sw-tab.general.descriptionTextModule',
    color: '#57D9A3',
    icon: 'regular-shopping-bag',
    entity: 'tab',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB,
    },

    routes: {
        list: {
            component: 'sw-tab-list',
            path: 'list',
            meta: {
                privilege: 'tab.viewer',
            },
        },
        create: {
            component: 'sw-tab-detail',
            path: 'create',
            meta: {
                parentPath: 'sw.tab.list',
                privilege: 'tab.creator',
            },
        },
        detail: {
            component: 'sw-tab-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'sw.tab.list',
                privilege: 'tab.viewer',
            },
            props: {
                default(route) {
                    return {
                        tabId: route.params.id,
                    }
                },
            },
        },
    },

    navigation: [
        {
            path: 'sw.tab.list',
            privilege: 'tab.viewer',
            label: 'sw-tab.general.mainMenuItemGeneral',
            id: 'sw-tab',
            parent: 'sw-catalogue',
            color: '#57D9A3',
            position: 100,
        },
    ],

    defaultSearchConfiguration,
})
