<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import FlashMessage from '@/Components/FlashMessage.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { getToday } from '@/common';

    // props はコントローラから渡されるデータ
    const props = defineProps({
        years: Array,
        min_year: Number,
        flash: Object,
      });

     // 今日の日付
    const today = getToday();

    // フォーム定義（複数削除フォームをそれぞれ管理）
    // 売上削除フォーム（startDate / endDate）
    const salesForm = useForm({
        startDate: today,
        endDate: today,
    });

    const hinbanForm = useForm({
        year1: props.min_year,
        year2: props.min_year,
      });

    // 単独削除系は CSRF 対策だけで OK
    const simpleForm = useForm({})
    </script>

    <template>
      <Head title="データ削除" />

      <AuthenticatedLayout>
        <template #header>

            <h2 class="font-semibold text-xl text-gray-800">データ削除</h2>
            <div class="flex ">
            <div class="p-2 ">
                <Link as="button" :href="route('admin.data.data_menu')" class="w-40 h-8 flex text-white bg-indigo-500 border-0 py-1 pl-12 focus:outline-none hover:bg-indigo-600 rounded text-ml">Data管理</Link>
            </div>
            <Link
              :href="route('admin.data.delete_index')"
              class="mt-2 ml-20 w-24 h-8 flex bg-gray-300 border-0 py-1 pl-8 focus:outline-none hover:bg-gray-400 rounded text-ml"
            >
              クリア
            </Link>
          </div>
        </template>

        <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- フラッシュメッセージ -->
          <FlashMessage />

          <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                <!-- 売上データ削除（日付指定） -->
        <div class="mb-6">
            <span class="block mb-2">売上データ削除（日付範囲）</span>

            <form
              @submit.prevent="salesForm.delete(route('admin.data.sales_destroy'))"
              class="flex items-center gap-2"
            >
              <input
                type="date"
                v-model="salesForm.startDate"
                class="w-32 h-8 rounded text-sm border"
              />
              <span>～</span>
              <input
                type="date"
                v-model="salesForm.endDate"
                class="w-32 h-8 rounded text-sm border"
              />

              <button
                type="submit"
                class="text-sm w-32 text-white bg-red-500 py-1 px-4 rounded hover:bg-red-600"
              >
                売上データ削除
              </button>
            </form>
          </div>


            <!-- 品番削除 -->
            <div class="mb-6">
              <form
                @submit.prevent="hinbanForm.delete(route('admin.data.hinban_destroy'))"
                class="flex items-center gap-2"
              >
                <select v-model="hinbanForm.year1" class="w-32 h-8 rounded text-sm">
                  <option value="">年度選択(from)</option>
                  <option v-for="year in props.years" :key="year.year_code" :value="year.year_code">
                    {{ year.year_code }}年度
                  </option>
                </select>
                <span>～</span>
                <select v-model="hinbanForm.year2" class="w-32 h-8 rounded text-sm">
                  <option value="">年度選択(to)</option>
                  <option v-for="year in props.years" :key="year.year_code" :value="year.year_code">
                    {{ year.year_code }}年度
                  </option>
                </select>
                <button
                  type="submit"
                  class="text-sm w-32 text-white bg-red-500 py-1 px-4 rounded hover:bg-red-600"
                >
                  品番削除
                </button>
              </form>
            </div>

            <!-- データ全削除 -->
            <div class="mt-8">
              <span class="block mb-2">データ全削除</span>

              <div class="flex flex-wrap gap-2">
                <form @submit.prevent="simpleForm.delete(route('admin.data.stock_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">在庫データ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.sku_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">SKUデータ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.col_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">Colデータ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.size_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">Sizeデータ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.unit_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">Unitデータ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.brand_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">Brandデータ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.shop_destroy_all'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">店舗データ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.company_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">会社データ削除</button>
                </form>
                <form @submit.prevent="simpleForm.delete(route('admin.data.area_destroy'))">
                  <button class="w-36 text-sm text-white bg-red-500 py-1 px-4 hover:bg-red-600 rounded">エリアデータ削除</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </AuthenticatedLayout>
    </template>

