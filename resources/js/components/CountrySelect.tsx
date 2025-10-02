import { useState, useMemo, memo } from 'react'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { countries } from '@/data/countries'

interface CountrySelectProps {
  value: string
  onValueChange: (value: string) => void
  placeholder?: string
  hasError?: boolean
  className?: string
}

const CountrySelect = memo(function CountrySelect({ 
  value, 
  onValueChange, 
  placeholder = "Select country",
  hasError = false,
  className = ""
}: CountrySelectProps) {
  const [searchTerm, setSearchTerm] = useState('')
  
  const filteredCountries = useMemo(() => {
    if (!searchTerm) return countries.slice(0, 50) // Show only first 50 countries initially
    return countries.filter(country =>
      country.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      country.code.toLowerCase().includes(searchTerm.toLowerCase())
    )
  }, [searchTerm])

  return (
    <Select value={value} onValueChange={onValueChange}>
      <SelectTrigger 
        className={`${hasError ? 'border-red-500' : ''} ${className}`}
      >
        <SelectValue placeholder={placeholder} />
      </SelectTrigger>
      <SelectContent className="max-h-60">
        {/* Search input */}
        <div className="p-2 border-b">
          <input
            type="text"
            placeholder="Search countries..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1"
          />
        </div>
        
        {/* Country options */}
        {filteredCountries.map((country) => (
          <SelectItem 
            key={country.code} 
            value={country.code}
          >
            {country.name}
          </SelectItem>
        ))}
        
        {filteredCountries.length === 0 && (
          <div className="p-2 text-muted-foreground text-sm">
            No countries found
          </div>
        )}
      </SelectContent>
    </Select>
  )
})

export default CountrySelect
