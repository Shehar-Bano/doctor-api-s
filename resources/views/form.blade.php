@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Subpage Information</h1>
    <form action="{{ route('subpage_info.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Section Title -->
        <div class="form-group">
            <label for="section_title">Section Title</label>
            <input type="text" name="section_title" id="section_title" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- Advantages -->
        <div class="form-group">
            <label for="advantages">Advantages (one per line)</label>
            <textarea name="advantages[]" id="advantages" class="form-control" rows="4" placeholder="Advantage 1"></textarea>
            <button type="button" id="add-advantage" class="btn btn-secondary mt-2">Add Another Advantage</button>
        </div>

        <!-- Questions and Answers -->
        <div class="form-group">
            <label for="questions_answers">Questions and Answers</label>
            <div id="qa-section">
                <div class="qa-pair">
                    <input type="text" name="questions_answers[0][question]" class="form-control" placeholder="Question" required>
                    <textarea name="questions_answers[0][answer]" class="form-control mt-2" rows="2" placeholder="Answer" required></textarea>
                </div>
            </div>
            <button type="button" id="add-qa" class="btn btn-secondary mt-2">Add Another Q&A</button>
        </div>

        <!-- Images -->
        <div class="form-group">
            <label for="images">Upload Images</label>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Information</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('add-advantage').addEventListener('click', function() {
        const advantagesSection = document.querySelector('.form-group textarea[name="advantages[]"]').cloneNode(true);
        advantagesSection.value = '';
        document.getElementById('advantages').parentElement.appendChild(advantagesSection);
    });

    document.getElementById('add-qa').addEventListener('click', function() {
        const qaSection = document.querySelector('.qa-pair').cloneNode(true);
        const qaCount = document.querySelectorAll('.qa-pair').length;
        qaSection.querySelector('input').name = `questions_answers[${qaCount}][question]`;
        qaSection.querySelector('textarea').name = `questions_answers[${qaCount}][answer]`;
        qaSection.querySelector('input').value = '';
        qaSection.querySelector('textarea').value = '';
        document.getElementById('qa-section').appendChild(qaSection);
    });
</script>
@endsection
