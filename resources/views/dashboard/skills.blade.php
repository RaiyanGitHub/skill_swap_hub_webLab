<x-app-layout>
    <div class="p-6">

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- 🔥 ADD SKILL FORM -->
        <form method="POST" action="{{ route('skills.store') }}" class="mb-6">
            @csrf

            <div class="flex gap-4">

                <!-- Skill Name -->
                <input
                    type="text"
                    name="name"
                    placeholder="Enter skill"
                    class="border p-2 rounded w-full"
                    required
                >

                <!-- Type -->
                <select name="type" class="border p-2 rounded">
                    <option value="know">I Know</option>
                    <option value="learn">Want to Learn</option>
                </select>

                <!-- Button -->
                <button class="bg-blue-500 text-white px-4 rounded">
                    Add
                </button>

            </div>
        </form>

        <!-- 🔥 Skills I Know -->
        <h2 class="text-xl font-bold mb-4">Skills I Know</h2>

        @foreach($skillsKnow as $skill)
            <div class="bg-white p-3 rounded shadow mb-2 flex justify-between items-center">

                <span>{{ $skill->name }}</span>

                <form method="POST" action="{{ route('skills.destroy', $skill->id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 hover:text-red-700">
                        Delete
                    </button>
                </form>

            </div>
        @endforeach


        <!-- 🔥 Skills I Want to Learn -->
        <h2 class="text-xl font-bold mt-6 mb-4">Skills I Want to Learn</h2>

        @foreach($skillsLearn as $skill)
            <div class="bg-white p-3 rounded shadow mb-2 flex justify-between items-center">

                <span>{{ $skill->name }}</span>

                <form method="POST" action="{{ route('skills.destroy', $skill->id) }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 hover:text-red-700">
                        Delete
                    </button>
                </form>

            </div>
        @endforeach

    </div>
</x-app-layout>
