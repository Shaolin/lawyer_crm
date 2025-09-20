<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 text-center">
        <h1 class="text-2xl font-bold text-green-600 mb-6">Payment Successful 🎉</h1>
        <pre class="bg-gray-100 p-4 rounded-lg text-left">
            {{ print_r($paymentDetails, true) }}
        </pre>
    </div>
</x-app-layout>
