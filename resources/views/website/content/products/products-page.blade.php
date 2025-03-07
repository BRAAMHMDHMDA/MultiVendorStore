<div>

  <!-- Start Page Header -->
  <x-website.breadcrumb current="Products" title="List Products" />
  <!-- End Page Header -->

  <!-- Product Categories Section Start -->
  <div id="content" class="product-area">
    <div class="container">
      <div id="alert" ></div>
      <div class="row">
        {{-- start Sidebar--}}
        <div class="col-md-3 col-sm-3 col-xs-12">
          <div>
            <div class="widget-search md-30">
              <input class="form-control" placeholder="Search By Product Name..." type="text" wire:model.debounce.500ms="search">
              <button type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
            <div class="widget-ct widget-categories mb-30">
              <div class="widget-s-title">
                <h4>Categories</h4>
              </div>
              <ul id="accordion-category" class="product-cat">
                <li>
                  <input type="radio" id="all" name="category" wire:model="category_selected" value="">
                  <label for="all" style="display: inline-block;font-weight: normal">All</label>
                </li>
                @foreach($categories as $category)
                  <li>
                    <input type="radio" id="{{$category->name}}" name="category" wire:model="category_selected" value="{{$category->slug}}" @checked(request()->category==$category->name)>
                    <label for="{{$category->name}}" style="display: inline-block; font-size: small;font-weight: normal">{{$category->name}} ({{$category->products_count}})</label>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="widget-ct widget-tags mb-30">
              <div class="widget-s-title">
                <h4>Tags</h4>
              </div>
              <ul id="accordion-category" class="product-cat">
                <li>
                  <input type="radio" id="all" name="tag" wire:click="$set('tags_selected', [])"  @checked(empty($tags_selected))>
                  <label for="all" style="display: inline-block;font-weight: normal">All</label>
                </li>
                @foreach($tags as $tag)
                  <li>
                    <input type="checkbox" id="tag_{{$tag->slug}}" name="tag" wire:model="tags_selected" value="{{$tag->slug}}">
                    <label for="tag_{{$tag->slug}}" style="display: inline-block; font-size: small; font-weight: normal">
                      {{$tag->name}}
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="widget-ct widget-filter mb-30">
              <div class="widget-s-title">
                <h4>Filter By Price</h4>
              </div>
              <!-- Range contents -->
              <div class="widget-info filter-price">
                <div  style="display: flex;gap: 20px">
                  <div style="display:flex;flex-direction: column; width: 40%">
                    <label>Min</label>
                    <input type="number" class="form-control" wire:model.debounce.300ms="min_price" min="0">
                  </div>
                  <div style="display:flex;flex-direction: column; width: 40%">
                    <label>Max</label>
                    <input type="number" class="form-control" wire:model.debounce.300ms="max_price">
                  </div>
                </div>
                <div class="filter-btn" style="display: flex; flex-direction: column; gap: 15px">
{{--                  <button class="btn btn-common" type="submit">Filter</button>--}}
                  <button class="btn btn-common" wire:click="clearFilter">Clear Filter</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- End Sidebar--}}

        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="shop-content" style="width: 100%">
            <div class="col-md-12">
              <div class="product-option mb-30 clearfix">
                <ul class="shop-tab">
                  <li class="active"><a aria-expanded="true" href="#grid-view" data-toggle="tab"><i class="icon-grid"></i></a></li>
                </ul>
                <!-- Size end -->
                <div class="showing text-right">
                  <p class="hidden-xs">Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} Results</p>
                </div>
              </div>
              <div class="col-12" wire:loading>
                <div class="d-flex justify-content-center">
                  <span class="loader"></span>
                </div>
              </div>
            </div>

            <div class="tab-content" wire:loading.remove>
              <div id="grid-view" class="tab-pane active">
                @foreach($products as $product)
                  <livewire:website.products.product-card :product="$product" wire:key="{{$product->id}}" class="col-md-4 col-sm-6 col-xs-12"/>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Start Pagination -->
          <div style="display: flex; justify-content: center; margin-top: 30px">
            <div class="" style="width: auto">
              {{$products->links('components.website.pagination')}}
            </div>
          </div>
          <!-- End Pagination -->

        </div>
      </div>
    </div>
  </div>
  <!-- Product Categories Section End -->
</div>
