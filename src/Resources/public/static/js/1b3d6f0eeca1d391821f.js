"use strict";(window["webpackJsonpPluginproduct-tabs-plugin"]=window["webpackJsonpPluginproduct-tabs-plugin"]||[]).push([[114],{114:function(t,n,a){a.r(n),a.d(n,{default:function(){return i}});let{Mixin:e}=Shopware,{Criteria:s}=Shopware.Data;var i={template:'{% block sw_tab_list %}\n<sw-page class="sw-tab-list">\n\n    {% block sw_tab_list_search_bar %}\n    <template #search-bar>\n        <sw-search-bar initial-search-type="Tab"\n            :initial-search="term"\n            @search="onSearch" />\n    </template>\n    {% endblock %}\n\n    {% block sw_tab_list_smart_bar_header %}\n    <template #smart-bar-header>\n        {% block sw_tab_list_smart_bar_header_title %}\n        <h2>\n            {% block sw_tab_list_smart_bar_header_title_text %}\n            {{ $tc(\'sw-tab.list.textTabOverview\') }}\n            {% endblock %}\n\n            {% block sw_tab_list_smart_bar_header_amount %}\n            <span v-if="!isLoading"\n                class="sw-page__smart-bar-amount">\n                ({{ total }})\n            </span>\n            {% endblock %}\n        </h2>\n        {% endblock %}\n    </template>\n    {% endblock %}\n\n    {% block sw_tab_list_actions %}\n    <template #smart-bar-actions>\n        {% block sw_tab_list_smart_bar_actions %}\n        <sw-button v-tooltip.bottom="{\n            message: $tc(\'sw-privileges.tooltip.warning\'),\n            disabled: acl.can(\'tab.creator\'),\n            showOnDisabledElements: true\n        }"\n            :router-link="{ name: \'sw.tab.create\' }"\n            :disabled="!acl.can(\'tab.creator\') || undefined"\n            class="sw-tab-list__add-tab"\n            variant="primary">\n            {{ $tc(\'sw-tab.list.buttonAddTab\') }}\n        </sw-button>\n        {% endblock %}\n    </template>\n    {% endblock %}\n\n    {% block sw_tab_list_language_switch %}\n    <template #language-switch>\n        <sw-language-switch @on-change="onChangeLanguage" />\n    </template>\n    {% endblock %}\n\n    <template #content>\n        {% block sw_tab_list_content %}\n        <div class="sw-tab-list__content">\n            {% block sw_tab_list_grid %}\n            <sw-entity-listing v-if="entitySearchable"\n                class="sw-tab-list__grid"\n                detail-route="sw.tab.detail"\n                :is-loading="isLoading"\n                :columns="tabColumns"\n                :repository="tabRepository"\n                :items="tabs"\n                :placeholder="$tc(\'sw-tab.list.placeholderContent\')"\n                :allow-edit="acl.can(\'tab.editor\') || undefined"\n                :allow-inline-edit="acl.can(\'tab.editor\') || undefined"\n                :allow-delete="acl.can(\'tab.deleter\') || undefined"\n                :show-selections="acl.can(\'tab.deleter\') || undefined"\n                identifier="sw-tab-list"\n                @update-records="updateTotal"\n                @page-change="onPageChange"\n                @column-sort="onSortColumn" />\n            {% endblock %}\n        </div>\n        {% endblock %}\n    </template>\n\n</sw-page>\n{% endblock %}\n',compatConfig:Shopware.compatConfig,inject:["repositoryFactory","acl"],mixins:[e.getByName("listing")],data(){return{tabs:null,isLoading:!0,sortBy:"name",sortDirection:"ASC",total:0,searchConfigEntity:"tab"}},metaInfo(){return{title:this.$createTitle()}},computed:{tabRepository(){return this.repositoryFactory.create("tab")},tabColumns(){return[{property:"name",dataIndex:"name",allowResize:!0,routerLink:"sw.tab.detail",label:this.$tc("sw-tab.list.columnName"),inlineEdit:"string",primary:!0},{property:"position",allowResize:!0,label:this.$tc("sw-tab.list.columnPosition"),inlineEdit:"number"},{property:"content",allowResize:!0,label:this.$tc("sw-tab.list.columnContent")}]},tabCriteria(){let t=new s(this.page,this.limit);return t.setTerm(this.term),t.addSorting(s.sort(this.sortBy,this.sortDirection,this.naturalSorting)),t}},methods:{onChangeLanguage(t){this.getList(t)},async getList(){this.isLoading=!0;let t=await this.addQueryScores(this.term,this.tabCriteria);return this.entitySearchable?(this.freshSearchTerm&&t.resetSorting(),this.tabRepository.search(t).then(t=>{this.tabs=t,this.total=t.total,this.isLoading=!1})):(this.isLoading=!1,this.total=0,!1)},updateTotal({total:t}){this.total=t}}}}}]);