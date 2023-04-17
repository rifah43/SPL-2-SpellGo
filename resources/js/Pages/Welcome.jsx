import { Link, Head } from '@inertiajs/react';

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Welcome" />
            <div className="flex flex-col justify-center items-center h-screen bg-center bg-cover" style={{backgroundImage: "url('/bg.jpg')"}}>
                <div className="fixed bottom-0 mb-8 flex justify-center">
                    {auth.user ? (
                        <Link
                            href={route('dashboard')}
                            className="block px-8 py-4 bg-pink-500 border-2 border-pink-800 text-center font-semibold text-black opacity-80 hover:opacity-50 dark:text-white-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >
                            Dashboard
                        </Link>
                    ) : (
                        <div className="flex justify-center">
                            <Link
                                href={route('login')}
                                className="block px-8 py-4 bg-pink-500 border-2 border-pink-800 text-center font-semibold text-black opacity-80 hover:opacity-50 dark:text-white-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 mr-2"
                            >
                                Log in
                            </Link>

                            <Link
                                href={route('register')}
                                className="block px-8 py-4 bg-pink-500 border-2 border-pink-800 text-center font-semibold text-black opacity-80 hover:opacity-50 dark:text-white-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-2"
                            >
                                Register
                            </Link>
                        </div>
                    )}
                </div>
            </div>
            <style>{`
                .bg-dots-darker {
                    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
                }
                @media (prefers-color-scheme: dark) {
                    .dark\\:bg-dots-lighter {
                        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
                    }
                }
            `}</style>
        </>
    );
}
