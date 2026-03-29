<div class="section-block bg-white/5 border border-white/10 rounded-3xl p-8 relative group" data-index="{{ $index }}">
    <button type="button" onclick="removeSection(this)" class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-red-500/20 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 z-20">
        <i data-lucide="x" class="w-4 h-4"></i>
    </button>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <!-- Media Column -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Media Element</label>
                <div class="flex bg-black/40 rounded-lg p-1">
                    <button type="button" onclick="toggleLayout(this, 'left')" class="layout-toggle px-3 py-1 rounded-md text-[8px] font-bold uppercase tracking-widest transition-all {{ ($section['layout'] ?? 'media-left') === 'media-left' ? 'bg-[#d4a574] text-black' : 'text-gray-500' }}">Left</button>
                    <button type="button" onclick="toggleLayout(this, 'right')" class="layout-toggle px-3 py-1 rounded-md text-[8px] font-bold uppercase tracking-widest transition-all {{ ($section['layout'] ?? '') === 'media-right' ? 'bg-[#d4a574] text-black' : 'text-gray-500' }}">Right</button>
                    <input type="hidden" name="sections[{{ $index }}][layout]" value="{{ $section['layout'] ?? 'media-left' }}" class="layout-input">
                </div>
            </div>

            <select name="sections[{{ $index }}][media_type]" onchange="updateMediaFields(this)" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs font-bold text-gray-300">
                <option value="image" {{ ($section['media_type'] ?? '') === 'image' ? 'selected' : '' }}>Static Image</option>
                <option value="video" {{ ($section['media_type'] ?? '') === 'video' ? 'selected' : '' }}>Video (YouTube/Vimeo)</option>
                <option value="lottie" {{ ($section['media_type'] ?? '') === 'lottie' ? 'selected' : '' }}>Lottie Animation</option>
            </select>

            <!-- Image Field -->
            <div class="media-field" data-type="image" style="display: {{ ($section['media_type'] ?? 'image') === 'image' ? 'block' : 'none' }}">
                @if(!empty($section['media_url']) && ($section['media_type'] ?? '') === 'image')
                    <img src="{{ asset('storage/' . $section['media_url']) }}" class="w-full h-32 object-cover rounded-xl mb-2 border border-white/10">
                @endif
                <input type="file" name="sections[{{ $index }}][media_file]" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#d4a574]/10 file:text-[#d4a574] hover:file:bg-[#d4a574]/20">
            </div>

            <!-- Video Field -->
            <div class="media-field" data-type="video" style="display: {{ ($section['media_type'] ?? '') === 'video' ? 'block' : 'none' }}">
                <input type="text" name="sections[{{ $index }}][video_url]" value="{{ $section['video_url'] ?? '' }}" placeholder="Paste Embed URL..." class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white">
            </div>

            <!-- Lottie Field -->
            <div class="media-field" data-type="lottie" style="display: {{ ($section['media_type'] ?? '') === 'lottie' ? 'block' : 'none' }}">
                <div class="space-y-3">
                    <input type="text" name="sections[{{ $index }}][lottie_url]" value="{{ $section['lottie_url'] ?? '' }}" placeholder="Lottie JSON URL..." class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-xs text-white">
                    <div class="relative">
                        <label class="text-[9px] text-gray-500 block mb-1 uppercase font-bold">OR Upload JSON File</label>
                        @if(!empty($section['lottie_path']))
                            <div class="text-[9px] text-green-500 mb-2">Current: {{ basename($section['lottie_path']) }}</div>
                        @endif
                        <input type="file" name="sections[{{ $index }}][lottie_file]" class="w-full text-[10px] text-gray-500">
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Column -->
        <div class="space-y-4">
            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Section Content</label>
            <div class="quill-editor h-48 bg-black/20 rounded-xl text-white">
                {!! $section['content'] ?? '' !!}
            </div>
            <input type="hidden" name="sections[{{ $index }}][content]" class="quill-content" value="{{ $section['content'] ?? '' }}">
        </div>
    </div>
</div>
