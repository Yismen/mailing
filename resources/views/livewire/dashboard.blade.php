<div>
    <div class="row">
        <div class="col-6 col-lg-4 col-xl-3 ">
            <x-report::infographic type="info" count="{{ $forms_count }}">
                Total Forms
            </x-report::infographic>
        </div>

        <div class="col-6 col-lg-4 col-xl-3">
            <x-report::infographic type="info" count="{{ $questions_count }}" icon="fas fa-question-circle">
                Total Questions
            </x-report::infographic>
        </div>

        <div class="col-6 col-lg-4 col-xl-3">
            <x-report::infographic type="info" count="{{ $entries_count }}" icon="fas fa-ranking-star">
                Total Entries
            </x-report::infographic>
        </div>
    </div>

    <h4>
        Main dashboard: A chart with last 12 interactions, can be weekly, monthly, daily, yearly, between dates
    </h4>

    <ul>
        <li>Last 12 interactions</li>
        <li>Filter by form</li>
        <li>Filter by question</li>
        <li>Filter by interaction</li>
        <li>Satisfaction level, vs # of questions</li>
        <li>At the bottom, a paginated table with the responses with the option to filter by form, dates</li>
    </ul>
</div>