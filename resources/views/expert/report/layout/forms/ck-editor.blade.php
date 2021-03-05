{{-- CKEDITOR REMARK --}}
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('REMARK') }}</h4>
    </div>

    <div class="card-body ">
        <div class="row">
            <p class="text-danger">
                @error('remark') {{ $message }} @enderror
            </p>
            <div class="ml-lg-3" wire:key="pm-editor" wire:ignore>
                <textarea class="editor" name="remark" id="editor" cols="50" rows="10" wire:model.defer="remark"
                    class="form-control" placeholder="@error('remark') {{ $message }} @enderror">
                </textarea>
            </div>
        </div>
    </div>
</div>
{{-- END OF CKEDITOR REMARK --}}
@push('scripts')
    <script>
        /*
         *  INISIALISAI CKEDITOR
         *  -----------------------
         * ckeditor di inisialisasi setelah livewire selesai di load
         * dengan seperti ini ckeditor akan me load value dari model livewire
         * selanjutnya nilai model akan diganti dari nilai yang diisikan di editor.
         */
        document.addEventListener('livewire:load', function() {
            ClassicEditor.create(document.querySelector(".editor"), {
                    toolbar: {
                        items: [
                            "heading",
                            "|",
                            "bold",
                            "italic",
                            "link",
                            "bulletedList",
                            "numberedList",
                            "|",
                            "outdent",
                            "indent",
                            "alignment",
                            "|",
                            "fontSize",
                            "|",
                            "undo",
                            "redo",
                        ],
                        shouldNotGroupWhenFull: true,
                    },
                    language: "en",
                    licenseKey: "",
                })
                .then((editor) => {
                    window.editor = editor;
                    // editor.setData( @this.remark ); // if editor doesnt show data, uncomment this
                    editor.model.document.on('change:data', () => {
                        // @this.remark = editor.getData();
                        @this.set('remark', editor.getData(), true);
                    })
                })
                .catch((error) => {
                    console.error(error);
                });
        })
    </script>
@endpush
