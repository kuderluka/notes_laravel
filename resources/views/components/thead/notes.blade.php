<thead>
<tr>
    <th>@sortablelink('user_id', 'User')</th>
    <th>@sortablelink('category_id', 'Category')</th>
    <th>@sortablelink('title', 'Title')</th>
    <th>@sortablelink('content', 'Content')</th>
    <th>@sortablelink('priority', 'Priority')</th>
    <th>@sortablelink('deadline', 'Deadline')</th>
    <th>@sortablelink('tags', 'Tags')</th>
    @if($public)
        <th>@sortablelink('public', 'Public')</th>
    @endif
</tr>
</thead>

