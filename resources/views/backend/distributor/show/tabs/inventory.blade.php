<div class="col-6">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @if (count($distributor->distributor_inventory))
                    @foreach ($distributor->distributor_inventory as $distributor_product)
                        <tr>
                            <td>
                                {{ $distributor_product->inventory->name }}
                            </td>
                            <td>
                                PHP {{ number_format($distributor_product->selling_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="3">This supplier does not have any product to display...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div><!--table-responsive-->