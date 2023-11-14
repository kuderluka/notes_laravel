<thead>
<tr>
    <th class="{{ request()->input('sort') === 'user_id' ? 'column_sorted' : '' }}">@sortablelink('user_id', 'User')</th>
    <th class="{{ request()->input('sort') === 'category_id' ? 'column_sorted' : '' }}">@sortablelink('category_id', 'Category')</th>
    <th class="{{ request()->input('sort') === 'title' ? 'column_sorted' : '' }}">@sortablelink('title', 'Title')</th>
    <th class="{{ request()->input('sort') === 'content' ? 'column_sorted' : '' }}">@sortablelink('content', 'Content')</th>
    <th class="{{ request()->input('sort') === 'priority' ? 'column_sorted' : '' }}">@sortablelink('priority', 'Priority')</th>
    <th class="{{ request()->input('sort') === 'deadline' ? 'column_sorted' : '' }}">@sortablelink('deadline', 'Deadline')</th>
    <th class="{{ request()->input('sort') === 'tags' ? 'column_sorted' : '' }}">@sortablelink('tags', 'Tags')</th>
    @if($public)
        <th class="{{ request()->input('sort') === 'public' ? 'column_sorted' : '' }}">@sortablelink('public', 'Public')</th>
    @endif
</tr>
</thead>

