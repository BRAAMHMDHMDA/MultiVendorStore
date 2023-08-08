<a href="{{ Route('dashboard.products.edit', $id) }}"  class="btn btn-outline btn-sm" >
    <i class="fa fa-edit "></i>
</a>

<a class="btn btn-outline btn-sm btn-delete" onclick="confirmDelete({{$id}})">
    <i class="fa fa-trash-can text-danger" ></i>
</a>

@if($is_trash)
    <form action="{{ route('dashboard.products.force-delete', $id) }}" method="post" id={{$id}}>
        {{ csrf_field() }}
        @method('DELETE')
    </form>
@else
    <form action="{{ route('dashboard.products.destroy', $id) }}" method="post" id={{$id}}>
        {{ csrf_field() }}
        @method('DELETE')
    </form>
@endif
