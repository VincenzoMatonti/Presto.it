<form class="mybgsec shadow rounded p-5" wire:submit="store">
    <x-shared.flash-message  />
   <div class="mb-3">
      <label for="title" class="form-label">{{__('ui.title')}}:</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model.live="title">
      @error('title')
         <p class="fst-italic text-danger" >{{ $message }}</p>
      @enderror
   </div>
   <div class="mb-3">
      <label for="description" class="form-label">{{__('ui.description')}}:</label>
      <textarea id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" wire:model.live="description"></textarea>
      @error('description')
         <p class="fst-italic text-danger" >{{ $message }}</p>
      @enderror
   </div>
   <div class="mb-3">
      <label for="price" class="form-label">{{__('ui.price')}}:</label>
      <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" wire:model.live="price">
      @error('price')
         <p class="fst-italic text-danger" >{{ $message }}</p>
      @enderror
   </div>
   <div class="mb-3">
      <select id="category" class="form-control @error('category') is-invalid @enderror" wire:model.blur="category">
         <option label disabled > {{__('ui.selectCategory')}} </option>
         @foreach ($categories as $category)
            <option value="{{ $category->id }}"> {{ __('ui.' . $category->name) }} </option>
         @endforeach
      </select>
      @error('category')
         <p class="fst-italic text-danger" >{{ $message }}</p>
      @enderror 
   </div>
   <div class="d-flex justify-content-center">
      <button type="submit" class="btn mybutton mt-3 shadow" >{{__('ui.publishArticle')}} <i class="fa-solid fa-wand-magic mx-1"></i></button>
   </div>
</form>