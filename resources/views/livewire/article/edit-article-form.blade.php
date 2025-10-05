<form class="mybgsec shadow rounded p-5" wire:submit="update">
   <x-shared.flash-message />
   <div class="mb-3">
      <label for="title" class="form-label">{{__('ui.title')}}:</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model.live="title">
      @error('title')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
   </div>
   <div class="mb-3">
      <label for="description" class="form-label">{{__('ui.description')}}:</label>
      <textarea id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" wire:model.live="description"></textarea>
      @error('description')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
   </div>
   <!-- caricamento delle immagini -->
   <div class="mb-3">
      <input type="file" wire:model.live="temporary_images" multiple
         class="form-control shadow @error('temporary_images.*') is-invalid @enderror" placeholder="Img/">
      @error('temporary_images.*')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
      @error('temporary_images')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
   </div>
   @if (!empty($images))
   <div class="row">
      <div class="col-12">
         <p>{{ __('ui.photo_preview') }}</p>
         <div class="row border border-4 border-success rounded shadow py-4">
            @foreach ($images as $key => $image)
            @php
            $url = method_exists($image, 'temporaryUrl')
            ? $image->temporaryUrl()
            : Storage::url($image->path ?? '');
            @endphp
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center my-3">
               <div class="img-preview mx-auto shadow rounded"
                  style="background-image: url('{{ $url }}');">
               </div>
               <button type="button" class="btn mt-1 btn-danger rounded-2 shadow"
                  wire:click="removeImage({{ $key }})">
                  <i class="fa-solid fa-trash"></i>
               </button>
            </div>
            @endforeach
         </div>
      </div>
   </div>
   @endif
   <div class="mb-3">
      <label for="price" class="form-label">{{__('ui.price')}}:</label>
      <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" wire:model.live="price">
      @error('price')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
   </div>
   <div class="mb-3">
      <select id="category" class="form-control @error('category') is-invalid @enderror" wire:model.blur="category">
         <option label disabled> {{__('ui.selectCategory')}} </option>
         @foreach ($categories as $category)
         <option value="{{ $category->id }}"> {{ __('ui.' . $category->name) }} </option>
         @endforeach
      </select>
      @error('category')
      <p class="fst-italic text-danger">{{ $message }}</p>
      @enderror
   </div>
   <div class="d-flex justify-content-center">
      <button type="submit" class="btn mybutton mt-3 shadow mx-3">{{__('ui.edit_article')}} <i class="fa-solid fa-wand-magic mx-1"></i></button>
      <button type="button" wire:click="closeForm" class="btn mybutton mt-3 shadow mx-3">{{__('ui.operation')}} <i class="fa-solid fa-xmark "></i></button>
   </div>
</form>