@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Título:</label>
    <input type="text" name="title" class="form-control" placeholder="Título:" value="{{ $product->title ?? old('title') }}">
</div>

<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
</div>

<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="5" class="form-control" >{{ $product->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <label>Imagem:</label>
    <img class="" src="{{ $product->title ?? old('image') }}" alt="{{ $product->title ?? old('image') }}" />
    <input type="file" name="image" class="form-control" value="{{ $product->image ?? old('image') }}" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark"> <i class="fas fa-save"></i> Salvar</button>
</div>
