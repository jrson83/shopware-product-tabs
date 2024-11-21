// https://github.com/shopware/shopware/blob/trunk/src/Administration/Resources/app/administration/src/module/sw-manufacturer/page/sw-manufacturer-detail/index.js
import template from './sw-tab-detail.html.twig'

const {
    Mixin,
    Data: { Criteria },
} = Shopware

const { mapPropertyErrors } = Shopware.Component.getComponentHelper()

export default {
    template,

    compatConfig: Shopware.compatConfig,

    inject: ['repositoryFactory', 'acl'],

    mixins: [
        Mixin.getByName('placeholder'),
        Mixin.getByName('notification'),
        Mixin.getByName('discard-detail-page-changes')('tab'),
    ],

    shortcuts: {
        'SYSTEMKEY+S': 'onSave',
        ESCAPE: 'onCancel',
    },

    props: {
        tabId: {
            type: String,
            required: false,
            default: null,
        },
    },

    data() {
        return {
            tab: null,
            isLoading: false,
            isSaveSuccessful: false,
        }
    },

    metaInfo() {
        return {
            title: this.$createTitle(this.identifier),
        }
    },

    computed: {
        identifier() {
            return this.placeholder(this.tab, 'name')
        },

        tabIsLoading() {
            return this.isLoading || this.tab == null
        },

        tabRepository() {
            return this.repositoryFactory.create('tab')
        },

        tooltipSave() {
            if (this.acl.can('tab.editor')) {
                const systemKey = this.$device.getSystemKey()

                return {
                    message: `${systemKey} + S`,
                    appearance: 'light',
                }
            }

            return {
                showDelay: 300,
                message: this.$tc('sw-privileges.tooltip.warning'),
                disabled: this.acl.can('order.editor'),
                showOnDisabledElements: true,
            }
        },

        tooltipCancel() {
            return {
                message: 'ESC',
                appearance: 'light',
            }
        },

        ...mapPropertyErrors('tab', ['name', 'position', 'content']),
    },

    watch: {
        tabId() {
            this.createdComponent()
        },
    },

    created() {
        this.createdComponent()
    },

    methods: {
        createdComponent() {
            Shopware.ExtensionAPI.publishData({
                id: 'sw-tab-detail__tab',
                path: 'tab',
                scope: this,
            })
            if (this.tabId) {
                this.loadEntityData()
                return
            }

            Shopware.State.commit('context/resetLanguageToDefault')
            this.tab = this.tabRepository.create()
        },

        async loadEntityData() {
            this.isLoading = true

            const [tabResponse] = await Promise.allSettled([
                this.tabRepository.get(this.tabId),
            ])

            if (tabResponse.status === 'fulfilled') {
                this.tab = tabResponse.value
            }

            if (tabResponse.status === 'rejected') {
                this.createNotificationError({
                    message: this.$tc(
                        'global.notification.notificationLoadingDataErrorMessage'
                    ),
                })
            }

            this.isLoading = false
        },

        abortOnLanguageChange() {
            return this.tabRepository.hasChanges(this.tab)
        },

        saveOnLanguageChange() {
            return this.onSave()
        },

        onChangeLanguage() {
            this.loadEntityData()
        },

        onSave() {
            if (!this.acl.can('tab.editor')) {
                return
            }

            this.isLoading = true

            this.tabRepository
                .save(this.tab)
                .then(() => {
                    this.isLoading = false
                    this.isSaveSuccessful = true
                    if (this.tabId === null) {
                        this.$router.push({
                            name: 'sw.tab.detail',
                            params: { id: this.tab.id },
                        })
                        return
                    }

                    this.loadEntityData()
                })
                .catch((exception) => {
                    this.isLoading = false
                    this.createNotificationError({
                        message: this.$tc(
                            'global.notification.notificationSaveErrorMessageRequiredFieldsInvalid'
                        ),
                    })
                    throw exception
                })
        },

        onCancel() {
            this.$router.push({ name: 'sw.tab.list' })
        },
    },
}
