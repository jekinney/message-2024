<template>
  <nav v-if="pages" class="flex justify-center mt-4">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: collection.current_page === 1 }">
        <button @click="previousPage" class="page-link">Previous</button>
      </li>

      <li v-for="page in pages" :key="page" class="page-item" :class="{ active: collection.current_page === page }">
        <button @click="gotoPage(page)" class="page-link">{{ page }}</button>
      </li>

      <li class="page-item" :class="{ disabled: collection.current_page === collection.last_page }">
        <button @click="nextPage" class="page-link">Next</button>
      </li>
    </ul>
  </nav>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
    props: {
        collection: {
            type: Object
        }
    },
    computed: {
        pages() {
            let pages = this.collection.last_page > 10 ? 10 : this.collection.last_page;

            if (pages > 1) {
                return Array.from({ length: pages }, (_, i) => i + 1);
            }
            return null;
        }
    },
    methods: {
        previousPage() {
            if (this.collection.current_page > 1) {
                this.submitPageChange(this.collection.prev_page_url);
            }
        },
        nextPage() {
            if (this.collection.current_page < this.collection.last_page) {
                this.submitPageChange(this.collection.next_page_url);
            }
        },
        gotoPage(page) {
            this.submitPageChange(this.collection.path+'?page='+page);
        },
        submitPageChange(url) {
            router.visit(url);
        }
    }
};
</script>

<style>
.pagination {
  display: inline-block;
}
.page-item {
  display: inline;
}
.page-link {
  cursor: pointer;
  padding: 0.5rem 1rem;
  border: 1px solid #ddd;
  background-color: #fff;
}
.page-link:hover {
  background-color: #eee;
}
.active .page-link {
  background-color: #007bff;
  color: #fff;
}
.disabled .page-link {
  pointer-events: none;
  background-color: #ddd;
  color: #999;
}
</style>
