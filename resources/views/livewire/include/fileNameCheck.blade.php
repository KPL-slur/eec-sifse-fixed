<div class="row">
    <div class="col-1 text-right pr-0">
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="Report"
                        wire:model="fileNameChecks">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="Berita Acara"
                        wire:model="fileNameChecks">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check check-inside-table">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="fileNameChecks[]" value="dummy"
                        wire:model="fileNameChecks"
                        x-bind:value="customFileName">
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    <div class="col-6">
        <p class="mb-0 mt-3">Report</p>
        <p class="mb-0">Berita</p>
        <input type="text" name="customFileName" id="customFileName" class="mt-1"
                x-model="customFileName">
    </div>
</div>