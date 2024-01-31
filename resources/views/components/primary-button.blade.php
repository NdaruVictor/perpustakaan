<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-green-400 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-500 focus:bg-green-700 dark:focus:bg-green-500 active:bg-green-700 dark:active:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
