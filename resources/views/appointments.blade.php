<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-slot name='content1'>
        <div class='flex flex-col max-w-lg m-auto'>
            <h1 class='text-4xl mb-5'>Upcoming Appointments</h1>
            <p>You have no upcoming appointments</p>

            <h1 class='text-4xl my-5'>Request an Appointment</h1>
            <form method='post' action=''>
                @csrf
                <div class='flex flex-col'>
                    <label for='phone' class='text-lg'>Phone</label>
                    <input type='tel' name='phone' id='phone' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='date' class='text-lg'>Date</label>
                    <input type='date' name='date' id='date' class='w-full p-2 border border-black rounded-lg' required>
                </div>
                <div class='flex flex-col'>
                    <label for='service' class='text-lg'>Service</label>
                    <select name='service' id='service' class='w-full p-2 border border-black rounded-lg' onchange='toggleDetailsField()' required>
                        <option value=''>Select a service</option>
                        <option value='1'>Inspection</option>
                        <option value='2'>Oil Change</option>
                        <option value='3'>Tire Rotation</option>
                        <option value='4'>Tune Up</option>
                        <option value='5'>Tire Change</option>
                        <option value='6'>Battery Change</option>
                        <option value='7'>Brake Change</option>
                        <option value='8'>Other</option>
                    </select>
                </div>
                <div id='details_div' class='flex flex-col hidden'>
                    <label for='message' class='text-lg'>Details</label>
                    <textarea name='details' id='details' class='w-full p-2 border border-black rounded-lg'></textarea>
                </div>
                <button type='submit' class='w-full p-2 mt-5 bg-blue-500 text-white rounded-lg'>Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>

<script>
    function toggleDetailsField() {
        if (document.getElementById('service').value == '8') {
            document.getElementById('details_div').classList.remove('hidden');
        } else {
            document.getElementById('details_div').classList.add('hidden');
        }
    }
</script>