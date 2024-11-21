import template from './sw-tab-list.html.twig'

const { Mixin } = Shopware
const { Criteria } = Shopware.Data

export default {
    template,

    compatConfig: Shopware.compatConfig,

    inject: ['repositoryFactory', 'acl'],

    mixins: [Mixin.getByName('listing')],

    data() {
        return {
            tabs: null,
            isLoading: true,
            sortBy: 'name',
            sortDirection: 'ASC',
            total: 0,
            searchConfigEntity: 'tab',
        }
    },

    metaInfo() {
        return {
            title: this.$createTitle(),
        }
    },

    computed: {
        tabRepository() {
            return this.repositoryFactory.create('tab')
        },

        tabColumns() {
            return [
                {
                    property: 'name',
                    dataIndex: 'name',
                    allowResize: true,
                    routerLink: 'sw.tab.detail',
                    label: this.$tc('sw-tab.list.columnName'),
                    inlineEdit: 'string',
                    primary: true,
                },
                {
                    property: 'position',
                    allowResize: true,
                    label: this.$tc('sw-tab.list.columnPosition'),
                    inlineEdit: 'number',
                },
                {
                    property: 'content',
                    allowResize: true,
                    label: this.$tc('sw-tab.list.columnContent'),
                },
            ]
        },

        tabCriteria() {
            const tabCriteria = new Criteria(this.page, this.limit)

            tabCriteria.setTerm(this.term)
            tabCriteria.addSorting(
                Criteria.sort(
                    this.sortBy,
                    this.sortDirection,
                    this.naturalSorting
                )
            )

            return tabCriteria
        },
    },

    methods: {
        onChangeLanguage(languageId) {
            this.getList(languageId)
        },

        async getList() {
            this.isLoading = true

            const criteria = await this.addQueryScores(
                this.term,
                this.tabCriteria
            )

            if (!this.entitySearchable) {
                this.isLoading = false
                this.total = 0

                return false
            }

            if (this.freshSearchTerm) {
                criteria.resetSorting()
            }

            return this.tabRepository.search(criteria).then((searchResult) => {
                this.tabs = searchResult
                this.total = searchResult.total
                this.isLoading = false
            })
        },

        updateTotal({ total }) {
            this.total = total
        },
    },
}
