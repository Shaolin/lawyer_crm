<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 text-center">
        <h1 class="text-2xl font-bold mb-6">Pay with Paystack</h1>
        
        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="inline-block">
            @csrf
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Pay ₦5,000
            </button>
        </form>
    </div>
</x-app-layout>
