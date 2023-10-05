<p>{{ $variable->name_fa }}</p>
<textarea name="variable_values[{{ $variable->normalizedName() }}]" rows="2" style="height: auto" placeholder="{{ $placeholder ?? ''  }}"
          class="{{ $variable->payload['direction'] ?? '' }}">{!! $task->variable_values[$variable->normalizedName()] ?? '' !!}</textarea>
