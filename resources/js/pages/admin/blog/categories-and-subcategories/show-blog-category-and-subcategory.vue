<template>
  <!-- SHOW BLOG CATEGORY & SUBCATEGORIES, SECTION START -->
  <div id="showBlogCategoryAndSubcategory" class="modal fade" tabindex="-1" aria-labelledby="showBlogCategoryAndSubcategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="showBlogCategoryAndSubcategoryLabel" class="modal-title">
            DISPLAY BLOG SUBCATEGORIES FOR: {{ showRow.blog_category_title }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
        </div>
        <div class="modal-body">
          <vue-good-table
            :columns="columns"
            :rows="showRow.blog_subcategories"
            :search-options="{
              enabled: true
            }"
            :pagination-options="{
              enabled: true,
              mode: 'records',
              perPage: 50,
              position: 'bottom',
              perPageDropdown: [100, 200, 300, 400, 500],
              dropdownAllowAll: false,
              setCurrentPage: 1,
              jumpFirstOrLast : true,
              firstLabel : 'First Page',
              lastLabel : 'Last Page',
              nextLabel: 'next',
              prevLabel: 'prev',
              rowsPerPageLabel: 'Rows per page',
              ofLabel: 'of',
              pageLabel: 'page',
              allLabel: 'All',
            }"
          />
          <div class="modal-buttons">
            <button ref="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- EDIT BLOG CATEGORY & SUBCATEGORIES, SECTION END -->
</template>

<script>
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'

export default {
  name: 'ShowBlogCategoryAndSubcategory',
  components: {
    VueGoodTable
  },
  middleware: 'auth',
  props: {
    showRow: {
      default: null,
      type: Object
    }
  },
  data: function () {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id'
        },
        {
          label: 'Subcategory Title',
          field: 'blog_subcategory_title'
        },
        {
          label: 'Blog subcategory path',
          field: 'blog_subcategory_path'
        }
      ]
    }
  }
}
</script>
