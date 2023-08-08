<div class="categories-wrapper white-bg">
    <h3 class="block-title">Product Categories</h3>
    <ul class="vertical-menu">
        @php
            $numOfCategories = 8;
            $mainCategories = $categories->take($numOfCategories);
            $otherCategories = $categories->slice($numOfCategories);
        @endphp
        @foreach($mainCategories as $category)
            @if($category->children->count() > 0)
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                        {{ $category->name }} <i class="caret-right fa fa-angle-right"></i>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($category->children as $child)
                            <li><a href="#">{{ $child->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="#">{{ $category->name }}</a>
                </li>
            @endif
        @endforeach

        @if($otherCategories->count() > 0)
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                    Others <i class="caret-right fa fa-angle-right"></i>
                </a>
                <ul class="dropdown-menu">
                    @foreach($otherCategories as $category)
                        @if($category->children->count() > 0)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown{{ $category->id }}" href="#" role="button"
                                   onclick="event.stopPropagation();this.closest('li.dropdown').classList.toggle('open');">
                                    {{ $category->name }} <i class="caret-right fa fa-angle-right"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($category->children as $child)
                                        <li><a href="#">{{ $child->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
</div>