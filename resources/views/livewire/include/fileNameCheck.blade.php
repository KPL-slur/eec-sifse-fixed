<div class="row">
    <div class="col-1 text-right pr-0">
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="Report"
                        wire:model.lazy="fileNameChecks">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="Berita Acara"
                        wire:model.lazy="fileNameChecks">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="dummy"
                        wire:model.lazy="fileNameChecks"
                        x-bind:value="customFileName" x-bind:disabled="disableCheck" 
                        x-on:click="if (disableInput){ disableInput = false } else { disableInput = true }">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    <div class="col-6">
        <p class="mb-0 mt-3">Report</p>
        <p class="mb-0">Berita Acara</p>
        <input type="text" name="customFileName" class="mt-1" onkeyup="limitInput(this)"
                x-model.lazy="customFileName" x-bind:disabled="disableInput" x-on:click="disableCheck = false">
    </div>
</div>