@extends('layout')
@section('content')
    <div class="accordion w-50" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Create new product
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form method="post" action="{{route('createProduct')}}">
                        @csrf
                        <h5>Product info</h5>
                        <label class="form-label" for="product-title">Product name: </label>
                        <input class="form-control" type="text" name="product-title" placeholder="Product name" id="product-title"
                               value="{{old('product-title')}}"><br>
                        @foreach($errors->get('product-title') as $error)
                            <br>{{$error}}
                        @endforeach
                        @include('variantForm')
                        <br>
                        <input class="btn btn-primary" type="submit" value="Create new product">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!$products->isEmpty())
        <hr>
        <h2>Products</h2>
        <table class="table table-striped">
            <tr>
                <th>Product</th>
                <th>Variant</th>
                <th>Reference</th>
                <th>Footprint</th>
                <th>Verifying grade</th>
                <th>Tags</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($products as $productTitle => $product)
                @foreach($product as $variants)
                    @foreach($variants as $variantInfo)
                        <tr>
                            @if($loop->first)
                                <td rowspan="{{count($variants)}}">
                                    {{$productTitle}}<br>
                                    <a href="{{route('addVariant', ['productID' => $variantInfo['product']->getKey()])}}" title="Add a variant to this product" target="_blank">Add variant</a><br>
                                    <a href="{{route('deleteProduct', ['productID' => $variantInfo['product']->getKey()])}}" title="This will delete the product and all it's variants.">Delete product</a>
                                </td>
                            @endif
                            <td>{{$variantInfo['variant']->title}}</td>
                            <td>{{$variantInfo['variant']->reference}}</td>
                            <td>{{$variantInfo['variant']->footprint}}{{$variantInfo['footprintUnit']->unit}}</td>
                            <td>{{$variantInfo['verifyingGrade']->title}}</td>
                            <td>
                                @foreach($variantInfo['tags'] as $tag)
                                    {{$tag['tag.title']}}: {{$tag['tag.value']}}@if(!$loop->last),<br>@endif
                                @endforeach
                            </td>
                            <td><a href="{{route('editVariant', ['variantID' => $variantInfo['variant']->getKey()])}}" title="Edit variant" target="_blank">Edit variant</a></td>
                            <td>
                                @if(!$loop->first)
                                    <a href="{{route('deleteVariant', ['variantID' => $variantInfo['variant']->getKey()])}}" title="">Delete variant</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </table>
    @endif
@endsection

