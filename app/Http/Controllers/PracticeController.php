<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IanLChapman\PigLatinTranslator\Parser;
use App\Member;
use App\Claim;
use App\Utilities\Practice;

class PracticeController extends Controller
{
    /**
     *
     */
    public function practice18()
    {
        $books = Member::with('tags')->get();

        foreach ($books as $book) {
            dump($book->title . ' is tagged with: ');
            foreach ($book->tags as $tag) {
                dump($tag->name . ' ');
            }
        }
    }

    /**
     *
     */
    public function practice17()
    {
        $book = Member::where('title', '=', 'The Great Gatsby')->first();

        dump($book->title . ' is tagged with: ');
        foreach ($book->tags as $tag) {
            dump($tag->name);
        }
    }

    /**
     *
     */
    public function practice16()
    {
        $books = Member::with('author')->get();

        foreach ($books as $book) {
            # Get the author from this book using the "author" dynamic property
            # "author" corresponds to the the relationship method defined in the Book model
            $author = $book->author;

            # Output
            dump($book->title . ' was written by ' . $author->first_name . ' ' . $author->last_name);
        }
    }

    /**
     * One to Many Read example
     */
    public function practice15()
    {
        # Get the first book as an example
        $book = Member::first();

        # Get the author from this book using the "author" dynamic property
        # "author" corresponds to the the relationship method defined in the Book model
        $author = $book->author;

        # Output
        dump($book->title . ' was written by ' . $author->first_name . ' ' . $author->last_name);
        dump($book->toArray());
    }

    /**
     * One to Many Create example
     */
    public function practice14()
    {
        $author = Claim::where('first_name', '=', 'J.K.')->first();

        $book = new Member;
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2017;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        #$book->author_id = $author->id; # Essentially the same thing as line 25
        $book->save();
        dump($book->toArray());
    }

    /**
     * [6 of 6] Solution to query practice from Week 11 assignment
     * Remove all books authored by “J.K. Rowling”
     */
    public function practice13()
    {
        # Show books before we do the delete
        Member::dump();

        # Do the delete
        Member::where('author', 'LIKE', 'J.K. Rowling')->delete();
        dump('Deleted all books where author like J.K. Rowling');

        # Show books after the delete
        Member::dump();

        Practice::resetDatabase();
        # Underlying SQL: delete from `books` where `author` LIKE 'J.K. Rowling'
    }

    /**
     * [5 of 6] Solution to query practice from Week 11 assignment
     * Find any books by the author “J.K. Rowling” and update the author name to be “JK Rowling”.
     */
    public function practice12()
    {
        Member::dump();

        # Approach # 1
        # Get all the books that match the criteria
        $books = Member::where('author', '=', 'J.K. Rowling')->get();

        $matches = $books->count();
        dump('Found ' . $matches . ' ' . str_plural('book', $matches) . ' that match this search criteria');

        if ($matches > 0) {
            # Loop through each book and update them
            foreach ($books as $book) {
                $book->author = 'JK Rowling';
                $book->save();
                # Underlying SQL: update `books` set `updated_at` = '20XX-XX-XX XX:XX:XX', `author` = 'JK Rowling' where `id` = '4'
            }
        }

        # Approach #2
        # More ideal - Requires 1 query instead of 3
        #Book::where('author', '=', 'J.K. Rowling')->update(['author' => 'JK Rowling']);

        Member::dump();

        Practice::resetDatabase();
    }

    /**
     * [4 of 6] Solution to query practice from Week 11 assignment
     * Retrieve all the books in descending order according to published date
     */
    public function practice11()
    {
        $books = Member::orderByDesc('published_year')->get();
        Member::dump($books);
        # Underlying SQL: select * from `books` order by `published_year` desc
    }

    /**
     * [3 of 6] Solution to query practice from Week 11 assignment
     * Retrieve all the books in alphabetical order by title
     */
    public function practice10()
    {
        $books = Member::orderBy('title', 'asc')->get();
        Member::dump($books);
        # Underlying SQL: select * from `books` order by `title` asc
    }

    /**
     * [2 of 6] Solution to query practice from Week 11 assignment
     * Retrieve all the books published after 1950.
     */
    public function practice9()
    {
        $books = Member::where('published_year', '>', 1950)->get();
        Member::dump($books);
        # Underlying SQL: select * from `books` where `published` > '1950'
    }

    /**
     * [1 of 6] Solution to query practice from Week 11 assignment
     * Retrieve the last 2 books that were added to the books table.
     */
    public function practice8()
    {
        $books = Member::orderBy('id', 'desc')->limit(2)->get();

        # Alternative approach using the `latest` convenience method:
        #$books = Book::latest()->limit(2)->get();

        Member::dump($books);
        # Underlying SQL: select * from `books` order by `id` desc limit 2
    }

    /**
     * DELETE a single row
     */
    public function practice7()
    {
        # First get a book to delete
        $book = Member::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }

    /**
     * UPDATE a single row
     */
    public function practice6()
    {
        # First get a book to update
        $book = Member::where('author', '=', 'J.K. Rowling')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby!';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }

    /**
     * READ all rows
     */
    public function practice5()
    {
        $book = new Member();
        $books = $book->all();

        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    /**
     * CREATE a new row
     */
    public function practice4()
    {
        # Instantiate a new Book Model object
        $book = new Member();

        # Set the properties
        # Note how each property corresponds to a field in the table
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published_year = 1997;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: ' . $book->title);
    }

    /**
     * Demonstrating using an external package
     */
    public function practice3()
    {
        $translator = new Parser();
        $translation = $translator->translate('Hello World');
        dump($translation);
    }

    /*
     * Demonstrating getting values from configs
     */
    public function practice2()
    {
        dump(config('mail.supportEmail'));

        # Disabling this line to prevent accidentally revealing mail related credentials on the prod. server
        //dump(config('mail'));
    }

    /**
     * Demonstrating the first practice example
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];

        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        } # Otherwise, load the requested method
        else {
            $method = 'practice' . $n;

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        }
    }
}
