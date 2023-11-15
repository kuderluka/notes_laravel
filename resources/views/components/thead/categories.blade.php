<thead>
<tr>
    <th class="{{ request()->input('sort') === 'title' ? 'column_sorted' : '' }}">@sortablelink('title', 'Title')</th>
    <th class="{{ request()->input('sort') === 'users' ? 'column_sorted' : '' }}">@sortablelink('users', 'Users')</th>
    <th class="{{ request()->input('sort') === 'color' ? 'column_sorted' : '' }}">@sortablelink('color', 'Color')</th>
</tr>
</thead>
